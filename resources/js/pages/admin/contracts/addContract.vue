<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-card>
            <v-container>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newContract.contract_name"
                            :rules="rules"
                            :error="errors['contract_name'] ? true:false"
                            label="Contract Name"
                        />
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-select
                            v-model="newContract.companyID"
                            @click="getCompanies"
                            :rules="rules"
                            :error="errors['kvk'] ? true:false"
                            :items="companies"
                            item-text="company_name"
                            item-value="id"
                            label="Company"
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-menu
                            ref="startDate"
                            v-model="startDate"
                            :close-on-content-click="false"
                            :return-value.sync="newContract.starting_at"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="newContract.starting_at"
                                label="Contract start date"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            />
                            </template>
                            <v-date-picker
                                v-model="newContract.starting_at"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="startDate = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="$refs.startDate.save(newContract.starting_at)"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-menu
                            ref="endingDate"
                            v-model="endingDate"
                            :close-on-content-click="false"
                            :return-value.sync="newContract.ends_at"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="newContract.ends_at"
                                label="Contract ending date"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            />
                            </template>
                            <v-date-picker
                                v-model="newContract.ends_at"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="endingDate = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="$refs.endingDate.save(newContract.ends_at)"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col>
                        <v-row>
                            <v-col>
                                <v-switch 
                                    label="Contract Active"
                                    v-model="active"
                                />
                            </v-col>
                        </v-row>
                    </v-col>
                    
                </v-row>
                <v-row>
                    <v-col>
                        <v-btn color="success" id="sendBtnComp" @click="createContract">Opslaan<v-icon>send</v-icon> </v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

import Contract from '../../../../models/contract'

export default {
    name: 'adminBar',
    components: {

    },
    props: {

    },
    data() {
        return {
            newContract: new Contract(),
            errors: [],
            rules: [
                v => !!v || 'Field is required'
            ],
            alert: false,
            alertColor: null,
            msg: [],
            companies: [],
            date: '',
            startDate: '',
            endingDate: '',
            active: false,
        }
    },
    created() {

    },
    computed: {
        ...mapGetters([

        ])
    },
    watch: {

    },
    mounted() {

    },
    methods: {
        createContract() {
            this.newContract.active = this.active
            this.$axios
                .post('api/contract', this.newContract)
                .then((response) => {
                    this.msg = response.data.succes
                    this.alert = true
                    this.alertColor = "success"
                    const that = this
                    setTimeout(function(){
                        that.alert = false
                        that.msg = []
                    }, 5000)
                })
                .catch((err) => {
                    const errosMsg = err.response.data.error
                    for(const errors in errosMsg){
                        this.msg.push(errosMsg[errors][0])
                    }
                    this.alert = true
                    this.alertColor = "error"
                    const that = this
                    setTimeout(function(){
                        that.alert = false
                        that.msg = []
                    }, 5000)
                })
        },
        getCompanies() {
            this.$axios
                .get('api/company')
                .then((response) => {
                    this.companies = response.data
                    console.log(this.companies)
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        clearAlert(){
            this.msg = []
            this.alert = false
        }
    }
}
</script>
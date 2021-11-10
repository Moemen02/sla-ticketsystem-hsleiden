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
                            v-model="newCompany.company_name"
                            :rules="rules"
                            :error="errors['company_name'] ? true:false"
                            label="Company name"
                        />
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newCompany.kvk"
                            :rules="rules"
                            :error="errors['kvk'] ? true:false"
                            label="kvk"
                        />
                    </v-col>
                </v-row>
                    <v-col>
                        <v-btn color="success" id="sendBtnComp" @click="addNewCompany">Save<v-icon>send</v-icon> </v-btn>
                    </v-col>
            </v-container>
        </v-card>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

import Company from '../../../../models/company'

export default {
    name:'adminBar',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
           newCompany: new Company(),
           errors: [],
           rules: [
                v => !!v || 'Field is required'
            ],
            alert: false,
            alertColor: null,
            msg: [],
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
        addNewCompany(){
            this.$axios
                .post('api/company', this.newCompany)
                .then((response) => {
                    this.alert = true
                    this.msg = response.data.succes
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
        clearAlert(){
            this.msg = []
            this.alert = false
        }
    }
}
</script>
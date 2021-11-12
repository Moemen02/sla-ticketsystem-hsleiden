<template>
    <div>
        <div class="contract">
            <v-card>
                <v-card-title primary-title>
                    <v-card-text>
                        <h3 class="headline mb-0">Contract {{currentContract.contract_name}}</h3>
                        <br>
                        <div>
                            <v-row>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="currentContract.id"
                                        label="Contract ID"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="currentContract.contract_name"
                                        label="Contract name"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentContract.companyID"
                                        label="Company ID"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentContract.starting_at"
                                        label="Starting at"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentContract.ends_at"
                                        label="Ends at"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentContract.created_at"
                                        label="created at"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                            </v-row>
                            <v-row>
                                
                                <v-col cols="12" sm="4" md="4">
                                    <v-switch
                                        v-model="currentContract.active"
                                        label="Active"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                            </v-row>
                        </div>
                    </v-card-text>
                </v-card-title>
                <v-card-actions>
                    <v-btn v-if="disabled == true" @click="disabled = !disabled" color="primary">Edit</v-btn>
                    <v-btn v-if="disabled == false" @click="editContract" color="success">Save</v-btn>
                    <v-btn v-if="disabled == false" @click="disabled = !disabled" color="error">Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'


export default {
    name:'',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
            currentContract: [],
            disabled: true
        }
    },
    created() {
        this.getCurrentContract()
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
        getCurrentContract(){
            this.$axios
                .get('api/contract/' + this.$route.params.id)
                .then((response) => {
                    this.currentContract = response.data[0]
                    console.log(this.currentContract)
                    // this.getCompanyContract(this.user.companyID)
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        getCompanyContract(companyID){
            this.$axios
                .get('api/company/' + companyID)
                .then((response) => {
                    this.userCompany = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        editContract(){
            console.log(this.currentContract)
            this.$axios
                .put('api/contract/' + this.$route.params.id ,this.currentContract)
                .then((response) => {
                    console.log(response.data)
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }
}
</script>
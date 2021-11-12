<template>
    <div>
        <div class="contract">
            <v-card>
                <v-card-title primary-title>
                    <v-card-text>
                        <h3 class="headline mb-0">Contract {{currentCompany.company_name}}</h3>
                        <br>
                        <div>
                            <v-row>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="currentCompany.id"
                                        label="Company ID"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="currentCompany.company_name"
                                        label="Contract name"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentCompany.total_employees"
                                        label="Total Employees"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentCompany.kvk"
                                        label="kvk"
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
                    <v-btn v-if="disabled == false" @click="editCompany" color="success">Save</v-btn>
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
            currentCompany: [],
            disabled: true
        }
    },
    created() {
        this.getCurrentCompany()
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
        getCurrentCompany(){
            this.$axios
                .get('api/currentComp/' + this.$route.params.id)
                .then((response) => {
                    this.currentCompany = response.data[0]
                    console.log(this.currentCompany)
                    // this.getCompanyContract(this.user.companyID)
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        editCompany(){
            console.log(this.currentCompany)
            this.$axios
                .put('api/company/' + this.$route.params.id ,this.currentCompany)
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
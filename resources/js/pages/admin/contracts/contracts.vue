<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-data-table
        :headers="headers"
        :items="Contracts"
        item-key=""
        class="elevation-1"
        :search="search"
        >
            <template v-slot:top>
                <v-text-field
                v-model="search"
                label="Search"
                class="mx-4"
                />
            </template>
            <template #item.active="{item}">
                <p v-if="item.active == 0">false</p>
                <p v-if="item.active == 1">true</p>
            </template>
            <template #item.actions="{item}">
                <v-icon @click="goToContract(item.id)" color="success" class="action-watch">remove_red_eye</v-icon>
                <v-icon @click="deleteContract(item.id)" color="error" class="action-delete">delete_forever</v-icon>
            </template>
        </v-data-table>
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
            msg: [],
            alerColor: null,
            alert: false,
            Contracts: [{}],
            search: "",
            headers: [
                {
                    text: 'User ID',
                    value: 'id',
                },
                {
                    text: 'Contract',
                    align: 'start',
                    sortable: false,
                    value: 'contract_name',
                },
                {
                    text: 'Ends at',
                    value: 'ends_at'
                },
                {
                    text: 'Contract active',
                    value: 'active'
                },
                {
                    text: 'company',
                    value: 'companyID'
                },
                {
                    text: '',
                    value: 'actions'
                },
            ],
        }
    },
    created() {
        this.getContracts()
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
        getContracts(){
            this.$axios
                .get('api/contract')
                .then((response) => {
                    this.Contracts = response.data
                    this.getCompanyContract()
                })
                .catch((err) => {
                    return err
                })
        },
        goToContract(id){
            this.$router.push({ path: '/contract/' + id })
        },
        deleteContract(id){
            this.$axios
                .delete('api/contract/' + id)
                .then((response) => {
                    console.log(response)
                    let i = this.Contracts.map(contract => contract.id).indexOf(id)
                    this.Contracts.splice(i, 1)
                    this.msg = "Contract deleted"
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
        getCompanyContract() {
            this.$axios
                .get('api/company')
                .then((response) => {
                    this.companies = response.data
                    for (let company in this.companies) {
                        for (let contract in this.Contracts) {
                            if (this.Contracts[contract].companyID == this.companies[company].id) {
                                this.Contracts[contract].companyID = this.companies[company].company_name
                            }
                        }
                    }
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
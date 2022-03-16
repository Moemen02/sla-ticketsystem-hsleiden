<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-data-table
        :headers="headers"
        :items="appData"
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
                <v-icon @click="deleteData(item.id, apiRoute)" color="error" class="action-delete">delete_forever</v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import appDataCtrl from '../../../mixins/appDataController'
import {
    mapState,
    mapGetters
} from 'vuex'

export default {
    name:'',
    mixins:[appDataCtrl],
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
            apiRoute: 'api/contract',
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
        this.getData(this.apiRoute)
        this.getCompanyContract()
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
        goToContract(id){
            this.$router.push({ path: '/contract/' + id })
        },
        getCompanyContract() {
            this.$axios
                .get('api/company')
                .then((response) => {
                    this.companies = response.data
                    for (let company in this.companies) {
                        for (let contract in this.appData) {
                            if (this.appData[contract].companyID == this.companies[company].id) {
                                this.appData[contract].companyID = this.companies[company].company_name
                            }
                        }
                    }
                })
                .catch((err) => {
                    return err
                })
        }
    }
}
</script>
<template>
    <div>
        <!-- {{Contracts}} -->
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
                <v-icon @click="goToUser(item.id)" color="success" class="action-watch">remove_red_eye</v-icon>
                <v-icon @click="toggleDeleteWarning(item.id)" color="error" class="action-delete">delete_forever</v-icon>
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
        goToUser(userId){
            console.log(userId)
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
        }
    }
}
</script>
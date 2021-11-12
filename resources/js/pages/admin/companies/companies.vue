<template>
    <div>
        <v-data-table
        :headers="headers"
        :items="companies"
        item-key="company name"
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
            <template #item.actions="{item}">
                <v-icon @click="goToCompany(item.id)" color="success" class="action-watch">remove_red_eye</v-icon>
                <v-icon @click="deleteCompany(item.id)" color="error" class="action-delete">delete_forever</v-icon>
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
    name:'adminBar',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
            companies: [],
            search: "",
            headers: [
                {
                    text: 'Company ID',
                    value: 'id',
                },
                {
                    text: 'Company name',
                    align: 'start',
                    sortable: false,
                    value: 'company_name',
                },
                {
                    text: 'kvk',
                    value: 'kvk'
                },
                {
                    text: 'Total employees',
                    value: 'total_employees'
                },
                {
                    text: '',
                    value: 'actions'
                },
            ],
        }
    },
    created() {
        this.getCompanies()
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
        getCompanies(){
            this.$axios
                .get('/api/company')
                .then((response) => {
                    this.companies = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        goToCompany(id){
            this.$router.push({ path: '/company/' + id })
        },
        deleteCompany(id){
            this.$axios
                .delete('api/company/' + id)
                .then((response) => {
                    console.log(response)
                    let i = this.companies.map(company => company.id).indexOf(id)
                    this.companies.splice(i, 1)
                })
        }
    }
}
</script>
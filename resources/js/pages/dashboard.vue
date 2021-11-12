<template>
    <div>
        <v-row>
            <v-col>
                <v-card class="card-container">
                    <div>
                        Total users:
                    </div>
                    <p >
                        {{users}}
                    </p>
                </v-card>
            </v-col>
            <v-col>
                <v-card class="card-container">
                    <div>Total Contracts:</div>
                    <p>{{contracts}}</p>
                </v-card>
            </v-col>
            <v-col>
                <v-card class="card-container">
                    <div>
                        Total Tickets:
                    </div>
                    <p>{{tickets}}</p>
                </v-card>
            </v-col>
            <v-col>
                <v-card class="card-container">
                    <div>
                        Total companies:
                    </div>
                    <p>
                        {{companies}}
                    </p>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    props: {
       
    },
    data() {
        return {
            users:[],
            contracts:[],
            tickets:[],
            companies:[],
        }
    },
    created() {
        this.getEverything()
    },
    computed: {

    },
    watch: {

    },
    mounted() {

    },
    methods: {
        getEverything(){
            this.getAllUsers()
            this.getAllContracts()
            this.getAllTickets()
            this.getAllCompanies()
        },
        getAllUsers(){
            this.$axios
                .get('api/users')
                .then((response) => {
                    this.users = response.data.length
                })
                
        },
        getAllContracts(){
            this.$axios
                .get('api/contract')
                .then((response) => {
                    this.contracts = response.data.length
                })
        },
        getAllTickets(){
            this.$axios
                .get('api/ticket')
                .then((response) => {
                    this.tickets = response.data.length
                })
        },
        getAllCompanies(){
            this.$axios
                .get('api/company')
                .then((response) => {
                    this.companies = response.data.length
                })
        }
    }
}
</script>
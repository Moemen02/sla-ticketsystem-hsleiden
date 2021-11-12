<template>
    <div>
        <v-row v-if="role == 'admin'">
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
import {
    mapState,
    mapGetters
} from 'vuex'

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
        ...mapGetters([
            'isAdmin',
            'userToken',
            'companyRole',
            'role'
        ]),
    },
    watch: {

    },
    mounted() {

    },
    methods: {
        getEverything(){
            if(this.role == 'admin'){
                this.getAllUsers()
                this.getAllContracts()
                this.getAllTickets()
                this.getAllCompanies()
            }

            console.log("hoi")
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
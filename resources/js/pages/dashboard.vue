<template>
    <div>
        <v-row v-if="role == 'admin'">
            <v-col>
                <v-card class="card-container">
                    <div>
                        Total users:
                    </div>
                    <hr>
                    <p >
                        {{users}}
                    </p>
                </v-card>
            </v-col>
            <v-col>
                <v-card class="card-container">
                    <div>Total Contracts:</div>
                    <hr>
                    <p>{{contracts}}</p>
                </v-card>
            </v-col>
            <v-col>
                <v-card class="card-container">
                    <div>
                        Total Tickets:
                    </div>
                    <hr>
                    <p>{{tickets}}</p>
                </v-card>
            </v-col>
            <v-col>
                <v-card class="card-container">
                    <div>
                        Total companies:
                    </div>
                    <hr>
                    <p>
                        {{companies}}
                    </p>
                </v-card>
            </v-col>
        </v-row>
        <v-row v-else>
            <v-col>
                <v-card>
                    <div>
                        My tickets:
                    </div>
                    <hr>
                    <p>
                        {{userTickets.length}}
                    </p>
                </v-card>
            </v-col>
            <v-col>
                <v-card>
                    <div>
                        Pending tickets:
                    </div>
                    <hr>
                    <p>
                        {{pendingTickets.length}}
                    </p>
                </v-card>
            </v-col>
            <v-col>
                <v-card>
                    <div>
                        Finished tickets:
                    </div>
                    <hr>
                    <p>
                        {{finishedTickets.length}}
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
            currentUser: [],
            userTickets: [],
            pendingTickets: [],
            finishedTickets: [],
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

            this.getCurrentUser()
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
        },
        getCurrentUser(){
            const TOKEN = 'Bearer '.concat(this.userToken)
            return this.$axios
                .get('api/user', {
                    headers: {
                        Authorization: TOKEN
                    }
                })
                .then(response => {
                    this.currentUser = response.data.currentUser.id
                    this.getUserTickets()
                })
                .catch(err => {
                    return err
                })
        },
        getUserTickets(){
            this.$axios
                .get('api/ticket/' + this.currentUser)
                .then((response) => {
                    this.userTickets = response.data.tickets
                    for(let ticket in this.userTickets){
                        if(this.userTickets[ticket].status == 'pending'){
                            this.pendingTickets.push(this.userTickets[ticket])
                        }
                    }
                    for(let ticket in this.userTickets){
                        if(this.userTickets[ticket].status == 'finished'){
                            this.finishedTickets.push(this.userTickets[ticket])
                        }
                    }
                })
        }
    }
}
</script>
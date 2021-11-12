<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-data-table
        :headers="headers"
        :items="myTickets"
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
            <template #item.actions="{item}">
                <v-icon @click="goToTicket(item.id)" color="success" class="action-watch">remove_red_eye</v-icon>
                <v-icon @click="deleteTicket(item.id)" color="error" class="action-delete">delete_forever</v-icon>
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
            myTickets: [],
            currentUser: [],
            users: '',
            search: "",
            headers: [
                {
                    text: 'Ticket name',
                    align: 'start',
                    sortable: false,
                    value: 'ticket_title',
                },
                {
                    text: 'Created at',
                    value: 'created_at'
                },
                {
                    text: 'Status',
                    value: 'status'
                },
                {
                    text: '',
                    value: 'actions'
                },
            ],
        }
    },
    created() {
        this.getCurrentUser()
    },
    computed: {
        ...mapGetters([
            'loggedIn',
            'userToken'
        ])
    },
    watch: {

    },
    mounted() {
        
    },
    methods: {
        getCurrentUser(){
            const TOKEN = 'Bearer '.concat(this.userToken)
            return this.$axios
                .get('api/user', {
                    headers: {
                        Authorization: TOKEN
                    }
                })
                .then(response => {
                    this.currentUser = response.data.currentUser
                    this.getMyTickets(response.data.currentUser.id)
                })
                .catch(err => {
                    return err
                })
        },
        goToTicket(id){
            this.$router.push({ path: '/ticket/' + id })
        },
        deleteTicket(id){
            this.$axios
                .delete('api/ticket/' + id)
                .then((response) => {
                    let i = this.myTickets.map(company => company.id).indexOf(id)
                    this.myTickets.splice(i, 1)
                    this.msg = "Ticket deleted"
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
        getMyTickets(userID){
            this.$axios
                .get('api/ticket/' + userID)
                .then((response) => {
                    this.myTickets = response.data.tickets
                    console.log(response.data.tickets[0].created_at)
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
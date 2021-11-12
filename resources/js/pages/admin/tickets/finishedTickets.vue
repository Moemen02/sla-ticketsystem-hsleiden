<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-data-table
        :headers="headers"
        :items="finishedTickets"
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
            Tickets: [{}],
            finishedTickets: [],
            users: '',
            search: "",
            headers: [
                {
                    text: 'User ID',
                    value: 'id',
                },
                {
                    text: 'Ticket',
                    align: 'start',
                    sortable: false,
                    value: 'ticket_title',
                },
                {
                    text: 'Requested by',
                    value: 'userID'
                },
                {
                    text: 'Assigned for',
                    value: 'assigned_for'
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
        this.getTickets()
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
        getTickets(){
            this.$axios
                .get('api/ticket')
                .then((response) => {
                    this.Tickets = response.data
                    for(let ticket in this.Tickets){
                        if(this.Tickets[ticket].status == 'finished'){
                            this.finishedTickets.push(this.Tickets[ticket])
                        }
                    }
                    this.getUsersTicket()
                })
                .catch((err) => {
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
                    let i = this.finishedTickets.map(company => company.id).indexOf(id)
                    this.finishedTickets.splice(i, 1)
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
        getUsersTicket() {
            this.$axios
                .get('api/users')
                .then((response) => {
                    this.users = response.data
                    for (let user in this.users) {
                        for (let ticket in this.Tickets) {
                            if (this.Tickets[ticket].userID == this.users[user].id) {
                                this.Tickets[ticket].userID = this.users[user].username
                            }
                        }
                    }
                })
                .catch((err) => {
                    return err
                })
        },
        clearAlert(){
            this.msg = []
            this.alert = false
        }
    }
}
</script>
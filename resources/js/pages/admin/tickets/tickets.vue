<template>
    <div>
        <!-- {{Tickets}} -->
        <v-data-table
        :headers="headers"
        :items="Tickets"
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
            Tickets: [{}],
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
                    this.getUsersTicket()
                })
                .catch((err) => {
                    return err
                })
        },
        goToUser(userId){
            console.log(userId)
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
                    console.log(err)
                })
        }
    }
}
</script>
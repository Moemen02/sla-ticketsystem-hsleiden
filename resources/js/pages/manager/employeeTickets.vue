<template>
    <div>
        <v-data-table
        :headers="headers"
        :items="tickets"
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
    name:'navbar',
    props: {
       
    },
    data() {
        return {
            currentUser: [],
            tickets: [],
            search: '',
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
        this.getCurrentUser()
    },
    computed: {
    ...mapGetters([
            'isAdmin',
            'userToken',
            'companyRole'
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
                    this.getEmployeesTicket(response.data.currentUser.companyID)
                })
                .catch(err => {
                    return err
                })
            },
        getEmployeesTicket(compID){
            this.$axios
                .get('api/tickets/' + compID)
                .then((response) => {
                    this.tickets = response.data
                    
                })
                .catch((err) => {
                    console.log(err)
                })
        },
    }
}
</script>
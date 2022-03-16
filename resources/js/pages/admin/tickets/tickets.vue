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
                <v-icon @click="goToTicket(item.id)" color="success" class="action-watch">remove_red_eye</v-icon>
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
    mixins: [appDataCtrl],
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
            users: '',
            search: "",
            apiRoute: 'api/ticket',
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
        this.getData(this.apiRoute),
        this.getUsersTicket()
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
        goToTicket(id){
            this.$router.push({ path: '/ticket/' + id })
        },
        getUsersTicket() {
            this.$axios
                .get('api/users')
                .then((response) => {
                    this.users = response.data
                    for (let user in this.users) {
                        for (let ticket in this.appData) {
                            if (this.appData[ticket].userID == this.users[user].id) {
                                this.appData[ticket].userID = this.users[user].username
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
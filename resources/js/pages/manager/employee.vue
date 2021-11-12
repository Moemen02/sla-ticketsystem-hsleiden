<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="employees"
            item-key="username, email, Phone number, company role"
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
            employees: [],
            currentUser: [],
            users: '',
            search: "",
            headers: [{
                    text: 'User ID',
                    value: 'id',
                },
                {
                    text: 'username',
                    align: 'start',
                    sortable: false,
                    value: 'username',
                },
                {
                    text: 'Email',
                    value: 'email'
                },
                {
                    text: 'Phone number',
                    value: 'phone_number'
                },
                {
                    text: 'company role',
                    value: 'companyRole'
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
                    this.getEmployees(response.data.currentUser.companyID)
                })
                .catch(err => {
                    return err
                })
            },
        getEmployees(compID){
            this.$axios
                .get('api/employees/' + compID)
                .then((response) => {
                    this.employees = response.data
                })
                .catch((err) => {
                    return err
                })
        },
    },
}
</script>
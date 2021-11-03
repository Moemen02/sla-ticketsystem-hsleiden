<template>
    <nav>
        <v-toolbar color="primary">
            <v-app-bar-nav-icon @click="sideBar = !sideBar" color="indigo lighten-4"></v-app-bar-nav-icon>
            <h1 class="current-route">test</h1>
            <v-spacer></v-spacer>
            <v-btn @click="logout()">
                <v-icon title="Logout">exit_to_app</v-icon>
            </v-btn>
        </v-toolbar>

        <v-navigation-drawer class="" color="" app v-model="sideBar">
            <div class="sideBarHead">
                <div class="navPfp">
                    <v-avatar class="cardAvatar" size="65">
                        <img
                            alt="user"
                            src="https://i.pinimg.com/564x/ae/ec/c2/aeecc22a67dac7987a80ac0724658493.jpg"
                        >
                    </v-avatar>
                </div>
                <div class="navTxt">
                    <p>{{userName}}</p>
                    <p>{{fullName}}</p>
                </div>
            </div>
            <AdminBar v-if="companyRole == 'admin' && role == 'admin'"/>
            <EmployeeBar v-if="companyRole == 'employee' && role == 'user'"/>
            <managerBar v-if="companyRole == 'manager' && role == 'user'"/>
        </v-navigation-drawer>
    </nav>
</template>
<script>
import {
    mapState,
    mapGetters
} from 'vuex'

import AdminBar from './adminBar.vue'
import EmployeeBar from './employeeBar.vue'
import managerBar from './managerBar.vue'

export default {
    name:'adminBar',
    components:{
        AdminBar,
        EmployeeBar,
        managerBar
    },
    props: {
       
    },
    data() {
        return {
            sideBar: true,
            currentUser: null,
            userName: null,
            fullName: null
        }
    },
    created() {
        this.getCurrentUser(),
        this.setUsername()
    },
    computed: {
    ...mapGetters([
            'isAdmin',
            'userToken',
            'companyRole',
            'role'
        ])
    },
    watch: {

    },
    mounted() {

    },
    methods: {
        getCurrentUser(){
            // console.log("test")
            const TOKEN = 'Bearer '.concat(this.userToken)
            return this.$axios
                .get('api/user', {
                    headers: {
                        Authorization: TOKEN
                    }
                })
                .then(response => {
                    this.currentUser = response.data.currentUser
                    this.userName = this.currentUser.username
                    this.fullName = this.currentUser.firstname + " " + this.currentUser.lastname
                })
                .catch(err => {
                    return err
                })
            },
        logout(){
            this.$axios
                .delete('api/logout/' + this.currentUser.id)
                .then((response) => {
                    this.$store.dispatch('resetState')
                    this.$router.push({
                        name: 'LoginPage'
                    })
                    return response
                })
                .catch((err) => {
                    return err
                })
        },
        setUsername(){
            
        }
    }
}
</script>
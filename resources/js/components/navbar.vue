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
            
            <v-list>
                <v-list-item-group>
                    <router-link to="/" class="router-link">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>dashboard</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Dashboard</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </router-link>

                    <div v-if="isAdmin == true" class="">
                        <v-list-group prepend-icon="account_circle">
                            <template v-slot:activator>
                                <v-list-item-title>Users</v-list-item-title>
                            </template>

                            <router-link to="/users/admins" exact-path class="router-link">
                                <v-list-item active-class="highlighted">
                                    <v-list-item-content>
                                        <v-list-item-title>Administrator</v-list-item-title>
                                    </v-list-item-content>
                                    <v-list-item-icon>
                                        <v-icon>perm_identity</v-icon>
                                    </v-list-item-icon>
                                </v-list-item>
                            </router-link>
                            
                            <router-link to="/users/clients" class="router-link">
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title>Client</v-list-item-title>
                                    </v-list-item-content>
                                    <v-list-item-icon>
                                        <v-icon>perm_identity</v-icon>
                                    </v-list-item-icon>
                                </v-list-item>
                            </router-link>
                        </v-list-group>

                        <router-link to="/contracts" class="router-link">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>book</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Contracten</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </router-link>

                        <router-link to="/tickets" class="router-link">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>local_activity</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Tickets</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </router-link>
                    </div>

                    <div v-else class="">
                         <router-link to="/contract" class="router-link">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>book</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Mijn Contracten</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </router-link>

                        <router-link to="/ticket" class="router-link">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>local_activity</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Mijn Tickets</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </router-link>
                    </div>

                </v-list-item-group>


            </v-list>
        </v-navigation-drawer>
    </nav>
</template>
<script>
export default {
    name:'navbar',
    props: {
       
    },
    data() {
        return {
            sideBar: true,
        }
    },
    computed: {

    },
    watch: {

    },
    mounted() {

    },
    methods: {
        
    }
}
</script>
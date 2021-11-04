<template>
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

            <div>

                <!-- users tab -->

                <v-list-group prepend-icon="account_circle">
                    <template v-slot:activator>
                        <v-list-item-title>Users</v-list-item-title>
                    </template>

                    <router-link to="/users" exact-path class="router-link">
                        <v-list-item active-class="highlighted">
                            <v-list-item-content>
                                <v-list-item-title>All users</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>perm_identity</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/admins">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Administrators</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>perm_identity</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/users-add">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Make new user</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>person_add_alt</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>
                </v-list-group>

                <!-- End users tab -->

                <!-- Contract tabs -->

                <v-list-group prepend-icon="book">

                    <template v-slot:activator>
                        <v-list-item-title>Contracts</v-list-item-title>
                    </template>

                    <router-link class="router-link" to="/contracts">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>All contracts</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>book</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/add-contract">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Make contract</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>post_add</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                </v-list-group>

                <!-- End Conract tab -->

                <!-- Ticket tab -->

                <v-list-group prepend-icon="local_activity">

                    <template v-slot:activator>
                        <v-list-item-title>Tickets</v-list-item-title>
                    </template>

                    <router-link class="router-link" to="/tickets">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>All Tickets</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>confirmation_number</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/tickets-pending">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Pending Tickets</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>hourglass_empty</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/tickets-finished">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Finished Tickets</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>check</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/tickets-add">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Make a Ticket</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>local_activity</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>
                </v-list-group>

                <!-- End ticket tab -->

                <!-- Companies tab -->

                <v-list-group prepend-icon="business">
                    <template v-slot:activator>
                        <v-list-item-title>Companies</v-list-item-title>
                    </template>

                    <router-link class="router-link" to="/company">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>All companies</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>business</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/company-add">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Add company</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>business</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                </v-list-group>

                <!-- End companies tab -->

            </div>

        </v-list-item-group>
    </v-list>
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
            
        }
    },
    created() {

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
        
    }
}
</script>
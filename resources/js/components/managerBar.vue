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

                <!-- Employees tab -->

                <router-link to="/employee" exact-path class="router-link">
                    <v-list-item active-class="highlighted">
                        <v-list-item-icon>
                            <v-icon>perm_identity</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Employees</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>

                <!-- End Employees tab -->

                <!-- Contract tabs -->

                <!-- <v-list-group prepend-icon="book">

                    <template v-slot:activator>
                        <v-list-item-title>Contracts</v-list-item-title>
                    </template>

                    <router-link class="router-link" to="">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>All contracts</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>book</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Make contract</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>post_add</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                </v-list-group> -->

                <!-- End Conract tab -->

                <!-- Ticket tab -->

                <v-list-group prepend-icon="local_activity">

                    <template v-slot:activator>
                        <v-list-item-title>Tickets</v-list-item-title>
                    </template>

                    <router-link class="router-link" to="/my-tickets">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>My Tickets</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>confirmation_number</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Employee Tickets</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>confirmation_number</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="/tickets/add">
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
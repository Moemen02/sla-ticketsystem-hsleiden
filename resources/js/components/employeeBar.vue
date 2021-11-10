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

                <!-- <v-list-group prepend-icon="business">
                    <template v-slot:activator>
                        <v-list-item-title>Companies</v-list-item-title>
                    </template>

                    <router-link class="router-link" to="">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>All companies</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>business</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                    <router-link class="router-link" to="">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Add company</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon>business</v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </router-link>

                </v-list-group> -->

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
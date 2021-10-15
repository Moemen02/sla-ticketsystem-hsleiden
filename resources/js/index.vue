<template>
    <v-app>
        <v-main class="grey lighten-4">
            <navbar v-if="loggedIn"/>
            <v-container >                
                <router-view> </router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

import navbar from './components/navbar.vue'
export default {
    components:{
        navbar,
    },
    props: {
       
    },
    data() {
        return {
            
        }
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
        
    }
}
</script>

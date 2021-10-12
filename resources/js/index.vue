<template>
    <v-app>
        <v-main class="grey lighten-4">
            <navbar/>
                <v-container >
                    <p>donkey balls</p>
                    
                    <router-view> </router-view>
                </v-container>
        </v-main>
    </v-app>
</template>

<script>
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

    },
    watch: {

    },
    mounted() {

    },
    methods: {
        
    }
}
</script>

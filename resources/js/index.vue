<template>
    <v-app>
        <v-container>
            <p>donkey balls</p>
            <router-view> </router-view>
        </v-container>
    </v-app>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

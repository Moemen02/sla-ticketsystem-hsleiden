<template>
    <v-app>
        <v-container>
            <p>donkey balls</p>
            <v-card-text>
                        <v-form>
                            <v-text-field 
                            prepend-icon="person" 
                            name="E-mail" 
                            label="E-mail" 
                            type="email"
                            v-model="email"
                            ></v-text-field>

                            <v-text-field 
                            prepend-icon="lock" 
                            id="password" 
                            name="password" 
                            label="Wachtwoord"
                            type="password" 
                            v-model="password"
                            @keyup.enter="login()"
                            ></v-text-field>
                            
                        </v-form>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" @click="login()">Login</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
            <router-view> </router-view>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: {
        addTicketForm: {
            type: Boolean,
            default: false
        },
        tickets: {

        }
    },
    data() {
        return {
            email: '',
            password: ''
        }
    },
    computed: {

    },
    watch: {

    },
    mounted() {
        // this.getClients()
    },
    methods: {
        login(){
            this.$axios
                .post('api/user/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    console.log(response)
                })
                .catch(err => {
                    return err
                })
        }
    }
}
</script>

<template>
    <div>
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
    </div>
</template>

<script>

export default {
    props: {
        
    },
    data() {
        return {
            email: '',
            password: '',
            token: ''
        }
    },
    computed: {

    },
    watch: {

    },
    mounted() {

    },
    methods: {
        login() {
            this.$axios
                .post('api/user/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    this.token = response.data.token

                    const TOKEN = 'Bearer '.concat(this.token)
                    return this.$axios
                        .get('api/user', {
                            headers: {
                                Authorization: TOKEN
                            }
                        })
                        .then(response => {
                            return response.data
                        })
                        .catch(err => {
                            return err
                        })
                })
                .catch(err => {
                    return err
                })
        }
    }
}
</script>
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
            <v-btn class="grey lighten-1" @click="login()">Login</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

export default {
    props: {
        
    },
    data() {
        return {
            email: '',
            password: '',
            newUserToken: '',
            currentUserData: null,
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
    created() {

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
                    this.$store.dispatch('login', response.data.userToken)
                    this.getCurrentuser()
                        .then(response => {
                            this.currentUserData = response.currentUser
                            this.$store.dispatch('companyRole', this.currentUserData.companyRole)
                        })
                    this.$router.push({
                        name: 'Dashboard'
                    })
                })
                .catch(err => {
                    return err
                })
        },
        getCurrentuser(){
            const TOKEN = 'Bearer '.concat(this.userToken)
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
        }
    }
}
</script>
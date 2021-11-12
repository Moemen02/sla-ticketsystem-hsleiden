<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-main>
         <v-container fluid fill-height>
            <v-layout align-center justify-center>
               <v-flex xs12 sm8 md4>
                  <v-card class="elevation-12">
                     <v-toolbar dark color="primary">
                        <v-toolbar-title>Login form</v-toolbar-title>
                     </v-toolbar>
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
                     </v-card-actions>
                  </v-card>
               </v-flex>
            </v-layout>
         </v-container>
      </v-main>
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
            msg: [],
            alerColor: null,
            alert: false,
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
                            this.$store.dispatch('role', this.currentUserData.role)
                        })
                    this.$router.go({
                        name: 'Dashboard'
                    })
                })
                .catch((err) => {
                    this.msg = "The username or password are invalid"
                    this.alert = true
                    this.alertColor = "error"
                    const that = this
                    setTimeout(function(){
                        that.alert = false
                        that.msg = []
                    }, 5000)
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
        },
        clearAlert(){
            this.msg = []
            this.alert = false
        }
    }
}
</script>
<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-card>
            <v-container>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newUser.username"
                            :rules="rules"
                            :error="errors['username'] ? true:false"
                            label="Username"
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newUser.firstname"
                            :rules="rules"
                            :error="errors['firstname'] ? true:false"
                            label="Firstname"
                        />
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newUser.lastname"
                            :rules="rules"
                            :error="errors['lastname'] ? true:false"
                            label="Lastname"
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newUser.email"
                            :rules="rules"
                            :error="errors['email'] ? true:false"
                            label="Email"
                        />
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newUser.password"
                            :type="show_password ? 'text' : 'password'"
                            :rules="rules"
                            :error="errors['password'] ? true:false"
                            label="Password"
                            :append-icon="vissibilityIcon"
                            @click:append="togglePassword"
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newUser.phone_number"
                            :rules="rules"
                            :error="errors['phone_number'] ? true:false"
                            label="Phone number"
                        />
                    </v-col>
                     <v-col cols="12" sm="6" md="6">
                        <v-select
                            @click="getCompanies()"
                            v-model="newUser.companyID"
                            :rules="rules"
                            :error="errors['company'] ? true:false"
                            :items="companies"
                            item-text="company_name"
                            item-value="id"
                            label="Company"
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-select
                            v-model="newUser.role"
                            :rules="rules"
                            :error="errors['company'] ? true:false"
                            :items="roles"
                            label="Role"
                        />    
                    </v-col>
                    <v-col v-if="newUser.role =='admin' " cols="12" sm="6" md="6">
                        <v-select
                            v-model="admin"
                            disabled
                            :rules="rules"
                            item-value="admin"
                            placeholder="admin"
                            :error="errors['company'] ? true:false"
                            label="Company role: admin"
                        />    
                    </v-col>
                    <v-col v-else cols="12" sm="6" md="6">
                        <v-select
                            v-model="newUser.companyRole"
                            :rules="rules"
                            :items="companyRoles"
                            :error="errors['company'] ? true:false"
                            label="Company Role"
                        />    
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-btn color="success" id="sendBtnComp" @click="createUser">Save<v-icon>send</v-icon> </v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

import User from '../../../models/user'

export default {
    name:'adminBar',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
            admin: "admin",
            newUser: new User(),
            alert: false,
            alertColor: null,
            errors: [],
            rules: [
                v => !!v || 'Field is required'
            ],
            show_password: false,
            vissibilityIcon: "visibility",
            roles: ['admin', 'user'],
            companyRoles:['manager', 'user'],
            companies: [],
            msg: []
        }
    },
    created() {
        
    },
    computed: {
    ...mapGetters([
            
        ])
    },
    watch: {

    },
    mounted() {

    },
    methods: {
        togglePassword(){
            this.show_password = !this.show_password
            if(this.vissibilityIcon == "visibility"){
                this.vissibilityIcon = "visibility_off"
            } else {
                this.vissibilityIcon = "visibility"
            }
        },
        getCompanies(){
            this.$axios
                .get('api/company')
                .then((response) => {
                    this.companies = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        createUser(){
            if(this.newUser.role == "admin"){
                this.newUser.companyRole = this.admin
            }

            this.$axios
                .post('api/user', this.newUser)
                .then((response) => {
                    this.msg = response.data.succes
                    this.alert = true
                    this.alertColor = "success"
                    const that = this
                    setTimeout(function(){
                        that.alert = false
                        that.msg = []
                    }, 5000)
                })
                .catch((err) => {
                    
                    const errosMsg = err.response.data.error
                    for(const errors in errosMsg){
                        this.msg.push(errosMsg[errors][0])
                    }

                    this.alert = true
                    this.alertColor = "error"

                    const that = this
                    setTimeout(function(){
                        that.alert = false
                        that.msg = []
                    }, 5000)
                })
        },
        clearAlert(){
            this.msg = []
            this.alert = false
        }
    }
}
</script>
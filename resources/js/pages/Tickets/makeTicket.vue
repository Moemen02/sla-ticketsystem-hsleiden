<template>
    <div>
         <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <v-card>
            <v-card-title>
                <h3>Create new ticket</h3>
            </v-card-title>
            <v-container >
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="newTicket.ticket_title"
                            :rules="rules"
                            :error="errors['ticket_title'] ? true:false"
                            label="Title"
                        />
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-textarea
                            v-model="newTicket.description"
                            :error="errors['ticket_title'] ? true:false"
                            label="Description"
                            prepend-icon="edit"
                            outlined
                        />
                    </v-col>
                </v-row>
                <div v-if="this.role == 'admin'">
                    <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-select
                                @click="getAllUsers"
                                v-model="newTicket.userID"
                                :rules="rules"
                                :error="errors['ticket_title'] ? true:false"
                                :items="users"
                                item-text="username"
                                item-value="id"
                                label="Request from"
                            />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        <v-menu
                            ref="due_at"
                            v-model="due_at"
                            :close-on-content-click="false"
                            :return-value.sync="newTicket.due_at"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="newTicket.due_at"
                                label="Ticket due at"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            />
                            </template>
                            <v-date-picker
                                v-model="newTicket.due_at"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="due_at = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="$refs.due_at.save(newTicket.due_at)"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    </v-row>
                </div>
                <v-row>
                    <v-col>
                        <v-btn v-if="this.role == 'user'" color="success" id="sendBtnComp" @click="makeTicket">Send Request<v-icon>send</v-icon> </v-btn>
                        <v-btn v-else color="success" id="sendBtnComp" @click="makeTicket">Save<v-icon>send</v-icon> </v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
        <!-- <v-expansion-panels>
             <v-expansion-panel>
                 <v-expansion-panel-header>
                     Extra Informatie
                 </v-expansion-panel-header>
                 <v-expansion-panel-content>
                     
                 </v-expansion-panel-content>
             </v-expansion-panel>
        </v-expansion-panels> -->
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

import Ticket from '../../../models/ticket'

export default {
    name:'adminBar',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
            currentUser: [],
            newTicket: new Ticket(),
            msg: [],
            alerColor: null,
            alert: false,
            rules: [
                v => !!v || 'Field is required'
            ],
            errors: [],
            users: [],
            due_at: '',
        }
    },
    created() {
        this.getCurrentUser()
    },
    computed: {
        ...mapGetters([
            'isAdmin',
            'userToken',
            'companyRole',
            'role'
        ]),
    },
    watch: {

    },
    mounted() {

    },
    methods: {
        getCurrentUser(){
        const TOKEN = 'Bearer '.concat(this.userToken)
        return this.$axios
            .get('api/user', {
                headers: {
                    Authorization: TOKEN
                }
            })
            .then((response) => {
                this.currentUser = response.data.currentUser
            })
            .catch(err => {
                return err
            })
        },
        getAllUsers(){
            this.$axios
                .get('api/users')
                .then((response) => {
                    this.users = response.data
                })
        },
        makeTicket(){
            if(this.role == 'user'){
                this.newTicket.userID = this.currentUser.id
                this.newTicket.companyID = this.currentUser.companyID
                this.newTicket.assigned_for = this.currentUser.username
            }

            for(let user in this.users){
                if(this.newTicket.userID == this.users[user].id){
                    this.newTicket.companyID = this.users[user].companyID
                    this.newTicket.assigned_for = this.users[user].username
                }
            }
            this.newTicket.assigned_by = this.currentUser.username
            this.$axios
                .post('api/ticket', this.newTicket)
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
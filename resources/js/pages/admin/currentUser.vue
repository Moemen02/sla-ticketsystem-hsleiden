<template>
    <div>
        <v-alert v-if="alert" :type="alertColor">
            <v-icon @click="clearAlert" class="float-right close-msg">cancel</v-icon> 
            <p>{{msg}}</p>
        </v-alert>
        <div class="User">
            <v-card>
                <v-card-title primary-title>
                    <v-card-text>
                        <h3 class="headline mb-0">User {{user.username}}</h3>
                        <br>
                        <div>
                            <v-row>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="user.id"
                                        label="User ID"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="user.email"
                                        label="Email"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="user.username"
                                        label="Username"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="user.firstname"
                                        label="Firstname"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="user.lastname"
                                        label="Lastname"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="user.role"
                                        label="role"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="user.companyRole"
                                        label="Company role"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="user.companyID"
                                        label="Company ID"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                            </v-row>
                        </div>
                    </v-card-text>
                </v-card-title>
                <v-card-actions>
                    <v-btn v-if="disabled == true" @click="disabled = !disabled" color="primary">Edit</v-btn>
                    <v-btn v-if="disabled == false" @click="editUser" color="success">Save</v-btn>
                    <v-btn v-if="disabled == false" @click="disabled = !disabled" color="error">Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </div>

        <div class="Tickets">
            <v-expansion-panels>
                <v-expansion-panel>
                    <v-expansion-panel-header>
                        Tickets
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <v-data-table
                            :headers="headers"
                            :items="userTickets"
                            item-key=""
                            class="elevation-1"
                        >
                            <template #item.active="{item}">
                                <p v-if="item.active == 0">false</p>
                                <p v-if="item.active == 1">true</p>
                            </template>
                        </v-data-table>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </div>
        
        <div class="Company">
            <v-expansion-panels>
                <v-expansion-panel>
                    <v-expansion-panel-header>
                        Company
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <v-data-table
                            :headers="header"
                            :items="userCompany"
                            item-key=""
                            class="elevation-1"
                        >
                            <template #item.active="{item}">
                                <p v-if="item.active == 0">false</p>
                                <p v-if="item.active == 1">true</p>
                            </template>
                        </v-data-table>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </div>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

import User from '../../../models/user'

export default {
    name:'',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
            msg: [],
            alerColor: null,
            alert: false,
            newUser: new User(),
            disabled: true,
            user: [],
            userTickets: [],
            userCompany: [],
            header: [
                {
                    text: 'Company name',
                    value: 'company_name'
                },
                {
                    text: 'Total employees',
                    value: 'total_employees'
                },
                {
                    text: 'kvk',
                    value: 'kvk'
                }
            ],
            headers: [
                {
                    text: 'User ID',
                    value: 'id',
                },
                {
                    text: 'Ticket',
                    align: 'start',
                    sortable: false,
                    value: 'ticket_title',
                },
                {
                    text: 'Status',
                    value: 'status'
                },
                {
                    text: '',
                    value: 'actions'
                },
            ],
        }
    },
    created() {
        this.getSelectedUser()
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
        getSelectedUser(){
            this.$axios
                .get('api/user/' + this.$route.params.id)
                .then((response) => {
                    this.user = response.data[0]
                    this.getUserTickets(this.user.id)
                    this.getUserCompany(this.user.companyID)
                })
                .catch((err) => {
                    return err
                })
        },
        getUserTickets(userID){
            this.$axios
                .get('api/ticket/' + userID)
                .then((response) => {
                    this.userTickets = response.data.tickets
                })
                .catch((err) => {
                    return err
                })
        },
        getUserCompany(companyID){
            this.$axios
                .get('api/company/' + companyID)
                .then((response) => {
                    this.userCompany = response.data
                })
                .catch((err) => {
                    return err
                })
        },
        editUser(){
            this.$axios
                .put('api/user/' + this.$route.params.id ,this.user)
                .then((response) => {
                    this.disabled = true
                    this.msg = "Edit completed"
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

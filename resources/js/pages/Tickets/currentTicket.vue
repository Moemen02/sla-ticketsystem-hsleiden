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
                        <h3 class="headline mb-0">Ticket {{currentTicket.ticket_title}}</h3>
                        <br>
                        <div v-if="role == 'admin'">
                            <v-row>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="currentTicket.id"
                                        label="Ticket ID"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="currentTicket.userID"
                                        label="User ID"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentTicket.ticket_title"
                                        label="Title"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-textarea
                                        v-model="currentTicket.description"
                                        label="Description"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentTicket.assigned_by"
                                        label="Assigned by"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentTicket.assigned_for"
                                        label="Assigned for"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentTicket.due_at"
                                        label="due at"
                                        outlined
                                        disabled
                                    />
                                </v-col>
                                
                                <v-col cols="12" sm="4" md="4">
                                    <v-select
                                        v-model="currentTicket.status"
                                        label="Status"
                                        :items="status"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                            </v-row>
                        </div>
                        <div v-else>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-text-field
                                        v-model="currentTicket.ticket_title"
                                        label="Title"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-textarea
                                        v-model="currentTicket.description"
                                        label="Description"
                                        outlined
                                        :disabled="disabled"
                                    />
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-select
                                        v-model="currentTicket.status"
                                        label="Status"
                                        :items="status"
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
                    <v-btn v-if="disabled == false" @click="editTicket" color="success">Save</v-btn>
                    <v-btn v-if="disabled == false" @click="disabled = !disabled" color="error">Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

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
            currentTicket: [],
            disabled: true,
            status: ['pending', 'finished']
        }
    },
    created() {
        this.getCurrentTicket()
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
        getCurrentTicket(){
            this.$axios
                .get('api/currentTicket/' + this.$route.params.id)
                .then((response) => {
                    this.currentTicket = response.data[0]
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        editTicket(){
            this.$axios
                .put('api/ticket/' + this.$route.params.id ,this.currentTicket)
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

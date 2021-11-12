<template>
    <div>
        <!-- {{admins}} -->
        <v-data-table
        :headers="headers"
        :items="admins"
        item-key="username, email, Phone number, company role"
        class="elevation-1"
        :search="search"
        >
            <template v-slot:top>
                <v-text-field
                v-model="search"
                label="Search"
                class="mx-4"
                />
            </template>
            <template #item.actions="{item}">
                <v-icon @click="goToUser(item.id)" color="success" class="action-watch">remove_red_eye</v-icon>
                <v-icon @click="deleteUser(item.id)" color="error" class="action-delete">delete_forever</v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import {
    mapState,
    mapGetters
} from 'vuex'

export default {
    name:'adminBar',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
            admins: [{}],
            search: "",
            headers: [
                {
                    text: 'User ID',
                    value: 'id',
                },
                {
                    text: 'username',
                    align: 'start',
                    sortable: false,
                    value: 'username',
                },
                {
                    text: 'Email',
                    value: 'email'
                },
                {
                    text: 'Phone number',
                    value: 'phone_number'
                },
                {
                    text: 'company role',
                    value: 'companyRole'
                },
                {
                    text: 'company',
                    value: 'companyID'
                },
                {
                    text: '',
                    value: 'actions'
                },
            ],
        }
    },
    created() {
        this.getAdmins()
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
        getAdmins(){
            this.$axios
                .get('api/admins')
                .then((response) => {
                    this.admins = response.data
                    this.getUserCompany()
                })
                .catch((err) => {
                    return err
                })
        },
        goToUser(userId) {
            this.$router.push({ path: '/user/' + userId })
        },
        deleteUser(id){
            this.$axios
                .delete('api/user/' + id)
                .then((response) => {
                    console.log(response)
                    let i = this.users.map(user => user.id).indexOf(id)
                    this.users.splice(i, 1)
                    this.msg = "User deleted"
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
        getUserCompany() {
            this.$axios
                .get('api/company')
                .then((response) => {
                    this.companies = response.data
                    for (let company in this.companies) {
                        for (let admin in this.admins) {
                            if (this.admins[admin].companyID == this.companies[company].id) {
                                this.admins[admin].companyID = this.companies[company].company_name
                            }
                        }
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }
}
</script>
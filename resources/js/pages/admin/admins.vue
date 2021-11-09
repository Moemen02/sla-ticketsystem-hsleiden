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
                <v-icon @click="toggleDeleteWarning(item.id)" color="error" class="action-delete">delete_forever</v-icon>
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
        goToUser(userId){
            console.log(userId)
        },
        getUserCompany() {
            this.$axios
                .get('api/company')
                .then((response) => {
                    this.companies = response.data
                    for (let company in this.companies) {
                        console.log(this.companies[company].id)
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
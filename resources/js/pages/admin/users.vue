<template>
    <div>
        <v-data-table
        :headers="headers"
        :items="users"
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
            users: [{}],
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
                    text: '',
                    value: 'actions'
                },
            ],
        }
    },
    created() {
        this.getUsers()
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
        getUsers(){
            this.$axios
                .get('api/users')
                .then((response) => {
                    this.users = response.data
                })
                .catch((err) => {
                    return err
                })
        },
        goToUser(userId){
            console.log(userId)
        }
    }
}
</script>
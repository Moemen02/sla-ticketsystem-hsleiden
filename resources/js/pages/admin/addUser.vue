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
                        <!-- <v-text-field
                            v-model="newContract.contract_name"
                            :rules="rules"
                            :error="errors['contract_name'] ? true:false"
                            label="Contract Name"
                        /> -->
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

import User from '../../../../models/user'

export default {
    name:'adminBar',
    components:{
        
    },
    props: {
       
    },
    data() {
        return {
            alert: false,
            alertColor: null,
            errors: [],
            rules: [
                v => !!v || 'Field is required'
            ],
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
        
    }
}
</script>
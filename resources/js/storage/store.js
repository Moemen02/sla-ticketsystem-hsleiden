import Vue from 'vue'
import Vuex from 'vuex'

import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export const store = new Vuex.Store({

    plugins: [createPersistedState()],

    state:{
        loggedIn: true,
        userToken: '',
        isAdmin: '',
    },

    mutations: {

    },

    actions: {

    },

    getters: {
        loggedIn: state => {
            return state.loggedIn
        },
        userToken: state => {
            return state.userToken
        },
        isAdmin: state => {
            return state.isAdmin
        }
    }
})
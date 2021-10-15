import Vue from 'vue'
import Vuex from 'vuex'

import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export const store = new Vuex.Store({

    plugins: [createPersistedState()],

    state:{
        loggedIn: false,
        userToken: '',
        isAdmin: '',
        role: '',
        companyRole: '',
    },

    mutations: {
        login: (state, token) => {
            state.userToken = token
            state.loggedIn = true
        }
    },

    actions: {
        login({commit}, token){
            commit('login', token)
        }
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
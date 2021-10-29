import Vue from 'vue'
import Vuex from 'vuex'

import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

function defaultState () {
    return{
        loggedIn: false,
        userToken: '',
        isAdmin: '',
        role: '',
        companyRole: '',  
    }
}

export const store = new Vuex.Store({

    plugins: [createPersistedState()],

    state: defaultState,
    // state:{
    //     loggedIn: false,
    //     userToken: '',
    //     isAdmin: '',
    //     role: '',
    //     companyRole: '',
    // },

    mutations: {
        login: (state, token) => {
            state.userToken = token
            state.loggedIn = true
        },
        companyRole: (state, compRole) => {
            state.companyRole = compRole
        },
        role: (state, role) => {
            state.role = role
        },
        resetState(state){
            Object.assign(state, defaultState())
        }
    },

    actions: {
        login({commit}, token){
            commit('login', token)
        },
        companyRole({commit}, compRole){
            commit('companyRole', compRole)
        },
        role({commit}, role){
            commit('role', role)
        },
        resetState({commit}){
            commit('resetState')
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
        },
        companyRole: state => {
            return state.companyRole
        },
        role: state => {
            return state.role
        }
    }
})
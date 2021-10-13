import Vue from 'vue'
import Vuex from 'vuex'

import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export const store = new Vuex.Store({

    plugins: [createPersistedState()],

    state:{
        loggedIn: true,
    },

   mutations: {

    },

    actions: {

    },

    getters: {
        loggedIn: state => {
            return state.loggedIn
        }
    }
})
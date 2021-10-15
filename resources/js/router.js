import Vue from "vue";
import Router from "vue-router"

import { store } from './storage/store'
 
Vue.use(Router)

import loginPage from './pages/loginPage'
import dashboard from './pages/dashboard'

const routes = [{
    path: '/',
    name: 'Dashboard',
    component: dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        name: 'LoginPage',
        component: loginPage,
        meta:{
            dissableIfLoggedIn: true
        }
    },
]

const router = new Router({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if(!store.getters.loggedIn){
            next({
                path: '/login'
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.dissableIfLoggedIn)) {
        if(store.getters.loggedIn){
            next({
                path: '/'
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         if (store.getters.loggedIn) {
//             next()
//             return
//         }
//         next('/login')
//     } else {
//         next('/')
//     }
// })

export default router
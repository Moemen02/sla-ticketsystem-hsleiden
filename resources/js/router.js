import Vue from "vue";
import Router from "vue-router"

import { store } from './storage/store'
 
Vue.use(Router)

// global pages
import loginPage from './pages/loginPage'
import dashboard from './pages/dashboard'
import addTicket from './pages/Tickets/makeTicket'
import myTickets from './pages/Tickets/myTickets'

// admin pages
import userPage from './pages/admin/users'
import adminPage from './pages/admin/admins'
import addUser from './pages/admin/addUser'

import finishedTickets from './pages/admin/tickets/finishedTickets'
import pendingTickets from './pages/admin/tickets/pendingTickets'
import ticketPage from './pages/admin/tickets/tickets'

import contracts from './pages/admin/contracts/contracts'
import addContract from './pages/admin/contracts/addContract'

import companies from './pages/admin/companies/companies'
import addCompany from './pages/admin/companies/addCompany'

// user - manager role pages
import employeePage from './pages/manager/employee'

// user - user role pages



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
    {
        path: '/tickets/add',
        name: 'addTicket',
        component: addTicket,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/my-tickets',
        name: 'myTickets',
        component: myTickets,
        meta: {
            requiresAuth: true
        }
    },


    {
        path: '/users',
        name: 'users',
        component: userPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admins',
        name: 'admins',
        component: adminPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/users/add',
        name: 'addUser',
        component: addUser,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: '/tickets',
        name: 'tickets',
        component: ticketPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/tickets/finished',
        name: 'finishedTickets',
        component: finishedTickets,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/tickets/pending',
        name: 'pendingTickets',
        component: pendingTickets,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: '/contracts',
        name: 'contracts',
        component: contracts,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/contracts/add',
        name: 'addContract',
        component: addContract,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: '/company',
        name: 'company',
        component: companies,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/company/add',
        name: 'addCompany',
        component: addCompany,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: '/employee',
        name: 'employee',
        component: employeePage,
        meta: {
            requiresAuth: true
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

export default router
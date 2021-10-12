import Vue from "vue";
import Router from "vue-router"

Vue.use(Router)

import loginPage from './pages/loginPage'
import dashboard from './pages/dashboard'

const routes = [{
    path: '/',
    component: dashboard,
},
{
    path: '/login',
    component: loginPage
}
]

export default new Router({
    mode: 'history',
    routes
})
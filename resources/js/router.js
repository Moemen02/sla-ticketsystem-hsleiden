import Vue from "vue";
import Router from "vue-router"

Vue.use(Router)

import loginPage from './pages/loginPage'
import example2 from './components/ExampleComponent'

const routes = [{
    path: '/othercomponent',
    component: example2,
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
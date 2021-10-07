import Vue from "vue";
import Router from "vue-router"

Vue.use(Router)

import example from './pages/vuepage'

const routes = [{
    path: '/othercomponent',
    component: example,
}]

export default new Router({
    mode: 'history',
    routes
})
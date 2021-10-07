import Vue from "vue";
import Router from "vue-router"

Vue.use(Router)

import example from './pages/vuepage'
import example2 from './components/ExampleComponent'

const routes = [{
    path: '/othercomponent',
    component: example,
},
{
    path: '/new',
    component: example2
}
]

export default new Router({
    mode: 'history',
    routes
})
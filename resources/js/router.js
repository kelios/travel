import Vue from 'vue'
import VueRouter from 'vue-router'
import TravelIndex from './components/TravelIndex.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/api/travels',
            name: 'TravelIndex',
            component: TravelIndex
        }
    ]
})

export default router

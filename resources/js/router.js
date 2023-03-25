import { createWebHistory, createRouter } from "vue-router";
import TravelIndex from "../components/TravelIndex.vue";

const routes = [
    {
        path: "/api/travels",
        component: TravelIndex,
        name: 'TravelIndex',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

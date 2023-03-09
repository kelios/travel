import { createWebHistory, createRouter } from "vue-router";
import TravelList from "./components/TravelList.vue";

const routes = [
    {
        path: "/api/travels",
        component: TravelList,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

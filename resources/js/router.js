import { createRouter, createWebHistory } from "vue-router";
import Login from './pages/login.vue'
import Register from './pages/register.vue'

const routes = [
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
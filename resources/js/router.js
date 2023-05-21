import { createRouter, createWebHistory } from "vue-router";
import Login from './pages/auth/login.vue'
import Register from './pages/auth/register.vue'

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
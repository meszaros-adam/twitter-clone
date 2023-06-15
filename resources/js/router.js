import { createRouter, createWebHistory } from "vue-router";
import Login from './pages/auth/login.vue'
import Register from './pages/auth/register.vue'
import Feed from './pages/feed.vue'
import Profile from './pages/profile.vue'

const routes = [
    {
        path: "/",
        name: "Feed",
        component: Feed,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/profile/:id",
        name: "Profile",
        component: Profile,
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
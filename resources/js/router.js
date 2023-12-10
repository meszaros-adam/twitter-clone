import { createRouter, createWebHistory } from "vue-router";
import Login from './pages/auth/login.vue'
import Register from './pages/auth/register.vue'
import Feed from './pages/feed.vue'
import AllTweets from './pages/allTweets.vue'
import Profile from './pages/profile.vue'
import Settings from './pages/settings.vue'

const routes = [
    {
        path: "/",
        name: "Feed",
        component: Feed,
    },
    {
        path: "/all-tweets",
        name: "All-Tweets",
        component: AllTweets,
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
    {
        path: "/settings/:id",
        name: "Settings",
        component: Settings,
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
<template>
    <div class="wrapper">
        <header>
            <router-link to="/" class="flex">
                <h1>Twitter Clone</h1>
                <img src="../../storage/app/images/bird-icon.png" alt="">
            </router-link>
            <button class="hamburger">
                <div class="bar"></div>
            </button>
        </header>
        <nav class="nav">
            <div>
                <div v-if="user">
                    <router-link :to="{ name: 'Profile', params: { id: user.id } }" class="rounded">
                        {{ user.nickname }}
                    </router-link>
                    <a href="/auth/logout">Logout</a>
                </div>
                <div v-else>
                    <router-link to="/login" class="rounded">Login</router-link>
                    <router-link to="/register" class="rounded">Register</router-link>

                </div>
            </div>
        </nav>
        <section class="content">
            <router-view></router-view>
        </section>
        <footer>
            Twitter Clone &copy; Mészáros Ádám 2023
        </footer>
    </div>
</template>

<script>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router'
export default {
    props: ["user"],
    setup() {

        const router = useRouter();

        //hamburger menu       
        onMounted(() => {
            const menuButton = document.querySelector('.hamburger');
            const nav = document.querySelector('.nav');

            //adding is-active to class list
            menuButton.addEventListener('click', function () {
                menuButton.classList.toggle('is-active')
                nav.classList.toggle('is-active')
            })

            //inactivate hamburger menu after route change 
            router.afterEach((to, from) => {
                nav.classList.remove('is-active')
                menuButton.classList.remove('is-active')
            })

        })
    }
}
</script>

<style></style>
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
                        <i class="fa-solid fa-user"></i>
                        <div> {{ user.nickname }}</div>
                    </router-link>
                    <router-link :to="{ name: 'Settings', params: { id: user.id } }" class="rounded">
                        <i class="fa-solid fa-bars"></i>
                        <div>Settings</div>
                    </router-link>
                    <a href="/auth/logout" class="rounded">
                        <i class="fa-solid fa-door-open"></i>
                        <div>Logout</div>
                    </a>
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
        <button id="up-arrow" @click="scrollUp" class="up-arrow">🠕</button>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router'
import { useFollowedsStore } from './stores/followeds';
import { useRetweetsStore } from './stores/retweets';
import { useUserStore } from './stores/user';
export default {
    props: ["user"],
    setup(props) {

        const router = useRouter();
        const user = ref(props.user)

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

        //up-arrow
        let upArrow = null;

        onMounted(() => {
            upArrow = document.getElementById("up-arrow")
        })

        const scrollFunc = () => {
            const y = window.scrollY

            if (y > 600) {
                upArrow.className = "up-arrow visible"
            }
            else {
                upArrow.className = "up-arrow"
            }
        }

        window.addEventListener("scroll", scrollFunc)

        const scrollUp = () => {
            window.scrollTo(0, 0);
        }

        //followeds
        const followedsStore = useFollowedsStore();
        let followeds = []

        if (user.value) {
            followeds = user.value.followeds.map(value => value.followed_id)
        }

        followedsStore.add(followeds)

        //retweets
        const retweetsStore = useRetweetsStore();

        let retweets = []

        if (user.value) {
            retweets = user.value.retweets.map(value => value.tweet_id)
        }

        retweetsStore.add(retweets)

        //user store

        const userStore = useUserStore()

        userStore.add(user.value)

        return { scrollUp, user }
    }


}
</script>

<style></style>
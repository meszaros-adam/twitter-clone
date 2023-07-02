<template>
    <div class="container">
        <h1 v-if="profile"> {{ profile.nickname }}</h1>
        <div class="container">
            <transition-group name="tweets" tag="ul">
                <tweetVue v-for="tweet in tweets" :key="tweet.id" :tweet="tweet">
                </tweetVue>
            </transition-group>
            <div v-if="showLoading" class="flex justify-center">
                <img class="loading-animation" src="/images/Spin-1.2s-200px.svg" alt="Loading animation">
            </div>
        </div>
    </div>
</template>

<script>
import { useRoute } from 'vue-router'
import callApi from '../composables/callApi'
import tweetVue from './components/tweet.vue'
import infiniteScroll from '../composables/infiniteScroll'
import { ref } from 'vue'
export default {
    components: { tweetVue },
    setup() {
        const route = useRoute()

        const profile = ref(null)
        const getProfile = async () => {
            const res = await callApi('get', `/get_user?id=${route.params.id}`)

            if (res.status == 200) {
                profile.value = res.data
            } else {

            }
        }
        getProfile()

        const tweets = ref([])
        const currentPage = ref(1)
        const lastPage = ref(2)
        const showLoading = ref(false)

        const getTweetsByProfile = async () => {

            if (lastPage.value > currentPage.value) {
                currentPage.value++
                showLoading.value = true

                const res = await callApi('get', `/get_tweets_by_user?user_id=${route.params.id}&page=${currentPage.value}`)

                if (res.status == 200) {
                    tweets.value.push(...res.data.data)
                    lastPage.value = res.data.last_page
                } else {

                }
                showLoading.value = false
            }
        }

        getTweetsByProfile()

        infiniteScroll(getTweetsByProfile)

        return { route, profile, tweets, showLoading }
    }
}
</script>
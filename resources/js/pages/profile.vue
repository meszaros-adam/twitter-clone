<template>
    <div class="container">
        <h1 v-if="profile"> {{ profile.nickname }}</h1>
        <tweetVue v-for="tweet in tweets" :key="tweet.id" :tweet="tweet">
        </tweetVue>
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
        let page = 1
        const getTweetsByProfile = async () => {
            page++

            const res = await callApi('get', `/get_tweets_by_user?user_id=${route.params.id}&page=${page}`)

            if (res.status == 200) {
                tweets.value.push(...res.data.data)

            } else {

            }
        }

        getTweetsByProfile()

        infiniteScroll(getTweetsByProfile)

        return { route, profile, tweets }
    }
}
</script>
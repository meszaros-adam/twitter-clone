<template>
    <div class="container">
        <h1 v-if="profile"> {{ profile.nickname }}</h1>
        <div v-for="tweet in tweets" :key="tweet.id" class="tweet">
            <div class="user">
                {{ tweet.user.nickname }}
            </div>
            <hr>
            <div class="text">
                {{ tweet.text }}
            </div>
        </div>
    </div>
</template>

<script>
import { useRoute } from 'vue-router'
import callApi from '../composables/callApi'
import { ref } from 'vue'
export default {
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

        const tweets = ref([])
        const getTweetsByProfile = async () => {

            const res = await callApi('get', `/get_tweets_by_user?user_id=${route.params.id}`)

            if (res.status == 200) {
                tweets.value.push(...res.data)
            } else {

            }

        }

        getProfile()
        getTweetsByProfile()

        return { route, profile, tweets }
    }
}
</script>
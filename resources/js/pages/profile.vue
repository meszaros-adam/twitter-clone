<template>
    <div class="container">
        <div class="flex">
            <h1 v-if="profile"> {{ profile.nickname }}</h1>
            <button v-if="!isFollowed" @click="follow" class="follow-button">Follow</button>
            <button v-if="isFollowed" @click="unfollow" class="follow-button">Unfollow</button>
        </div>
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
import { useFollowedsStore } from '../stores/followeds'
import { ref, computed, toRaw } from 'vue'
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
        const currentPage = ref(0)
        const lastPage = ref(1)
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

        //follow unfollow 
        const followedsStore = useFollowedsStore();

        const follow = async () => {
            const res = await callApi('post', '/create_follow', { 'followed_id': route.params.id })

            if (res.status == 201) {
                console.log('Succesful follow')
                followedsStore.add(route.params.id)
            } else {
                console.log('Follow failed')
            }
        }

        const unfollow = async () => {
            const res = await callApi('post', '/delete_follow', { 'followed_id': route.params.id })

            if (res.status == 200) {
                console.log('Succesful delete')
                followedsStore.remove(route.params.id)
            } else {
                console.log('Delete failed')
            }
        }

        //is this page followed or not
        const isFollowed = computed(() => {
            return followedsStore.getFolloweds.includes(parseInt(route.params.id))
        });

        return { route, profile, tweets, showLoading, follow, unfollow, isFollowed }
    }
}
</script>
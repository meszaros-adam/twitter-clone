<template>
    <div class="centering-on-desktop">
        <writeTweetVue></writeTweetVue>
        <div class="container">
            <feedNavigationVue></feedNavigationVue>
            <transition-group name="tweets" tag="ul">
                <tweetVue v-for="tweet in tweets" :key="[tweet.id, tweet.retweet_id].toString()" :tweet="tweet"
                    @retweetRemoved="removeFromList">
                </tweetVue>
            </transition-group>
            <div v-if="showLoading" class="flex justify-center">
                <img class="loading-animation" src="/images/Spin-1.2s-200px.svg" alt="Loading animation">
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import callApi from '../composables/callApi';
import writeTweetVue from './components/writeTweet.vue';
import tweetVue from './components/tweet.vue';
import infiniteScroll from '../composables/infiniteScroll'
import feedNavigationVue from './components/feedNavigation.vue';
import { useUserStore } from '../stores/user';
export default {
    components: { tweetVue, writeTweetVue, feedNavigationVue },
    setup(props) {

        //tweet loading

        const tweets = ref([])
        const lastPage = ref(1)
        const showLoading = ref(false)
        const currentPage = ref(0)
        const user = useUserStore()

        const getTweets = async () => {

            if (lastPage.value > currentPage.value) {
                currentPage.value++
                showLoading.value = true

                const res = await callApi('get', `/get_tweets_by_follow?page=${currentPage.value}`)

                if (res.status == 200) {
                    tweets.value.push(...res.data.data)
                    lastPage.value = res.data.last_page

                } else {

                }

                showLoading.value = false

            }

        }

        getTweets()

        infiniteScroll(getTweets)



        const removeFromList = (id) => {
            tweets.value = tweets.value.filter((tweet) => tweet.retweet_id !== id)
        }


        return { tweets, showLoading, removeFromList }
    }
}
</script>



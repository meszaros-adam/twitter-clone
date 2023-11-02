<template>
    <div class="centering-on-desktop">
        <writeTweetVue @newTweet="addToList"></writeTweetVue>
        <div class="container">
            <feedNavigationVue></feedNavigationVue>
            <transition-group name="tweets" tag="ul">
                <tweetVue v-for="tweet in tweets" :key="[tweet.id, tweet.retweet_id].toString()" :tweet="tweet"
                    @retweetRemoved="removeFromList" @commentButtonClicked="showingTweetModal(tweet)">
                </tweetVue>
            </transition-group>
            <div v-if="showLoading" class="flex justify-center">
                <img class="loading-animation" src="/images/Spin-1.2s-200px.svg" alt="Loading animation">
            </div>
        </div>
    </div>
    <tweetModalVue v-if="showTweetModal" :tweet="tweetValue" @closeModal="showTweetModal = false"></tweetModalVue>
</template>

<script>
import { ref } from 'vue';
import callApi from '../composables/callApi';
import writeTweetVue from './components/writeTweet.vue';
import tweetVue from './components/tweet.vue';
import infiniteScroll from '../composables/infiniteScroll'
import feedNavigationVue from './components/feedNavigation.vue';
import tweetModalVue from './components/tweetModal.vue';
import { useUserStore } from '../stores/user';
export default {
    components: { tweetVue, writeTweetVue, feedNavigationVue, tweetModalVue },
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

                if (res.status === 200) {
                    tweets.value.push(...res.data.data)
                    lastPage.value = res.data.last_page
                }
                else if (res.status == 401) {
                    window.location = '/login'
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



        //add to list if user follows himself
        const addToList = (tweet) => {
            if (user.getFolloweds.includes(user.getUser.id)) {
                tweets.value.unshift(tweet)
            }
        }

        //show Tweet Modal

        const tweetValue = ref({})
        const showTweetModal = ref(false)

        const showingTweetModal = (tweet) => {
            tweetValue.value = tweet
            showTweetModal.value = true
        }



        return { tweets, showLoading, removeFromList, addToList, showTweetModal, tweetValue, showingTweetModal }
    }
}
</script>



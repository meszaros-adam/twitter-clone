<template>
    <div class="centering-on-desktop">
        <div class="container">
            <alertVue :text="alertText"></alertVue>
            <textarea v-model="newTweet" placeholder="Write a new tweet!"> </textarea>
            <div>
                <button @click="sendTweet" class="button">Send</button>
            </div>
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
import alertVue from './components/alert.vue';
import tweetVue from './components/tweet.vue';
import infiniteScroll from '../composables/infiniteScroll'
import { ref } from 'vue';
import callApi from '../composables/callApi';
export default {
    components: { alertVue, tweetVue },
    setup() {

        //tweet sending
        const newTweet = ref('')

        const alertText = ref('')

        const sendTweet = async () => {

            if (newTweet.value.trim().length < 3) alertText.value = "A tweet must be at least 3 characters!"
            if (newTweet.value.trim().length > 140) alertText.value = "A tweet must be max 140 characters!"

            const res = await callApi('post', '/create_tweet', { tweet: newTweet.value })

            if (res.status == 201) {
                tweets.value.unshift(res.data)

                newTweet.value = ""

            } else {
                console.log('Failed to send the tweet!')
            }
        }

        //tweet loading

        const tweets = ref([])
        const lastPage = ref(1)
        const showLoading = ref(false)
        const currentPage = ref(0)

        const getTweets = async () => {

            if (lastPage.value > currentPage.value) {
                currentPage.value++
                showLoading.value = true

                const res = await callApi('get', `/get_all_tweets?page=${currentPage.value}`)

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



        return { newTweet, sendTweet, alertText, tweets, showLoading }
    }
}
</script>

<style>
.tweets-move,
.tweets-enter-active,
.tweets-leave-active {
    transition: all 1s ease;
}

.tweets-enter-from {
    opacity: 0;
    transform: translateY(-50px);
}

.tweets-leave-to {
    opacity: 0;
}

.tweets-leave-active {
    position: absolute;
}
</style>


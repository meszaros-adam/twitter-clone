<template>
    <div class="centering-on-desktop">
        <div class="container">
            <alertVue :text="alertText"></alertVue>
            <textarea v-model="newTweet" placeholder="Write a new tweet!"> </textarea>
            <div>
                <buttonVue @click="sendTweet">Send</buttonVue>
            </div>
        </div>
        <div class="container">
            <transition-group name="tweets" tag="ul">
                <tweetVue v-for="tweet in tweets" :key="tweet.id" :tweet="tweet">

                </tweetVue>
            </transition-group>
        </div>
    </div>
</template>

<script>
import buttonVue from './components/button.vue'
import alertVue from './components/alert.vue';
import tweetVue from './components/tweet.vue';
import { ref } from 'vue';
import callApi from '../composables/callApi';
export default {
    components: { buttonVue, alertVue, tweetVue },
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

        const getTweets = async () => {

        }

        return { newTweet, sendTweet, alertText, tweets }
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


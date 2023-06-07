<template>
    <div class="container">
        <div class="centering-on-desktop">
            <div class="textarea-container">
                <alertVue :text="alertText"></alertVue>
                <textarea v-model="newTweet" placeholder="Write a new tweet!"> </textarea>
                <buttonVue @click="sendTweet">Send</buttonVue>
            </div>
        </div>
        <div class="container">
            <div v-for="tweet in tweets" class="flex justify-center">
                {{ tweet.text }}
            </div>
        </div>
    </div>
</template>

<script>
import buttonVue from './components/button.vue'
import alertVue from './components/alert.vue';
import { ref } from 'vue';
import callApi from '../composables/callApi';
export default {
    components: { buttonVue, alertVue },
    setup() {
        const newTweet = ref('')

        const tweets = ref([])

        const alertText = ref('')

        const sendTweet = async () => {

            if (newTweet.value.trim().length < 3) alertText.value = "A tweet must be at least 3 characters!"
            if (newTweet.value.trim().length > 140) alertText.value = "A tweet must be max 140 characters!"

            const res = await callApi('post', '/create_tweet', { tweet: newTweet.value })

            if (res.status == 201) {
                console.log('szia')
                tweets.value.unshift(res.data)

            } else {

            }
        }

        return { newTweet, sendTweet, alertText, tweets }
    }
}
</script>


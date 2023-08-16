<template>
    <div class="container">
        <alertVue :text="alertText"></alertVue>
        <textarea v-model="newTweet" placeholder="Write a new tweet!"> </textarea>
        <div>
            <button @click="sendTweet" class="button">Send</button>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import alertVue from './alert.vue'
import callApi from '../../composables/callApi';
export default {
    components: { alertVue },
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

        return { sendTweet, alertText, newTweet }
    }
}
</script>
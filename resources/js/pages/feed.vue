<template>
    <div class="centering-on-desktop">
        <div class="textarea-container">
            <alertVue :text="alertText"></alertVue>
            <textarea v-model="newTweet" placeholder="Write a new tweet!"> </textarea>
            <buttonVue @click="sendTweet">Send</buttonVue>
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
            
            const res = callApi('post', '/create_tweet', newTweet)

            if (res.status == 200) {
                tweets.value.unshift(res.data.text)
            } else {

            }
        }

        return { newTweet, sendTweet, alertText }
    }
}
</script>


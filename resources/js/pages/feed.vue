<template>
    <div class="container">
        <div class="flex justify-center">
            <textarea v-model="newTweet" placeholder="Write a new tweet!"> </textarea>
        </div>
        <buttonVue class="">Send</buttonVue>
    </div>
</template>

<script>
import { ref } from 'vue';
import callApi from '../composables/callApi';
import buttonVue from './components/button.vue'
export default {
    components: { buttonVue },
    setup() {
        const newTweet = ref('')

        const tweets = ref([])

        const sendTweet = async () => {
            const res = callApi('post', '/create_tweet', newTweet)

            if (res.status == 200) {
                tweets.value.unshift(res.data.text)
            } else {

            }
        }

        return { newTweet, sendTweet }
    }
}
</script>


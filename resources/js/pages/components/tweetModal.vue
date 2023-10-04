<template>
    <div>
        <div class="modal">
            <div class="modal-container container rounded">
                <tweetVue :tweet="tweet"></tweetVue>
                <h1>Comments</h1>
                <hr>
                <div class="container comments rounded">
                    <div class="container">
                        <textarea v-model="comment" name="comment" id="" cols="30" rows="10"
                            placeholder="Write comment!"></textarea>
                        <div class="flex justify-end">
                            <button @click="sendComment" class="button">Send comment</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="overlay"></div>
        <button @click="$emit('closeModal')" class="close-button button">
            Close
        </button>
    </div>
</template>

<script>
import { ref } from 'vue';
import tweetVue from './tweet.vue';
import callApi from '../../composables/callApi';
export default {
    props: ["tweet"],
    components: { tweetVue },
    setup(props) {

        const tweet = props.tweet

        const comments = ref([])

        const comment = ref('')

        const sendComment = async () => {

            const res = await callApi('post', '/create_comment', { 'text': comment.value, 'tweet_id': tweet.id })

            if (res.status == 201) {
                comments.unshift(res.data)
            } else {
                console.log('Failed to send comment!')
            }
        }

        return { comment, comments, sendComment }

    }

}
</script>

<style scoped>
.overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
    z-index: 100;
}

.modal {
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    position: fixed;
    top: 20%;
    z-index: 101;
    transition: all 3s ease-in-out;
}

.modal-container {
    background-color: #61677A;
}

.close-button {
    position: fixed;
    right: 40px;
    top: 40px;
    z-index: 100;
}

h1 {
    margin-top: 3rem;
}

.comments {}
</style>
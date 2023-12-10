<template>
    <div>
        <div class="modal">
            <div @scroll="scrollModal" id="modal" class="modal-container container rounded">
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
                        <div v-for="comment in comments" :key="comment.id" class="comment container rounded">
                            <div class="nickname">
                                <router-link :to="{ name: 'Profile', params: { id: tweet.user.id } }">
                                    {{ tweet.user.nickname }}
                                </router-link>
                                <hr>
                            </div>
                            <div>
                                {{ comment.text }}
                            </div>
                        </div>
                        <div v-if="showLoading" class="flex justify-center">
                            <img class="loading-animation" src="/images/Spin-1.2s-200px.svg" alt="Loading animation">
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
import { ref, onMounted } from 'vue';
import tweetVue from './tweet.vue';
import callApi from '../composables/callApi';
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
                comments.value.unshift(res.data)
            } else {
                console.log('Failed to send comment!')
            }
        }

        const currentPage = ref(0);
        const lastPage = ref(1);
        const showLoading = ref(false)

        const getComments = async () => {

            if (lastPage.value > currentPage.value) {
                showLoading.value = true
                currentPage.value++
                const res = await callApi('get', `/get_comments?tweet_id=${tweet.id}&page=${currentPage.value}`)

                if (res.status == 200) {
                    comments.value.push(...res.data.data)
                    lastPage.value = res.data.last_page
                } else {
                    console.log('Failed to load comments!')
                }
                showLoading.value = false
            }
        }

        getComments()

        //infinite scrolling

        const scrollModal = () => {
            const modal = document.getElementById("modal")
            if (Math.ceil(modal.scrollTop + modal.offsetHeight) >= modal.scrollHeight) {
                getComments()
            }
        }



        return { comment, comments, sendComment, scrollModal, showLoading }

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
    top: 10%;
    z-index: 101;
    transition: all 3s ease-in-out;
}

.modal-container {
    background-color: #61677A;
    max-height: calc(80vh);
    overflow-y: auto;
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

.comment {
    background-color: black;
    color: whitesmoke;
}

.comment .nickname {
    margin-bottom: 1rem;
}
</style>
<template>
    <div class="tweet rounded">
        <div class="user_and_date">
            <div>
                <router-link :to="{ name: 'Profile', params: { id: tweet.user.id } }">
                    {{ tweet.user.nickname }}
                </router-link>
            </div>
            <div>
                {{ tweet.created_at }}
            </div>
        </div>
        <hr>
        <div class="text">
            {{ tweet.text }}
        </div>
        <div class="flex tweet-icons">
            <i v-if="!isRetweeted" @click="createRetweet" class="fa-solid fa-retweet" title="Retweet"></i>
            <i v-if="isRetweeted" @click="deleteRetweet" class="fa-solid fa-retweet retweet-active"
                title="Delete retweet"></i>
            <i class="fa-regular fa-comments" title="Comments"></i>
        </div>
    </div>
</template>

<script>
import { computed } from 'vue'
import callApi from '../../composables/callApi'
import { useRetweetsStore } from '../../stores/retweets'
export default {
    props: ["tweet"],
    setup(props) {

        const retweetStore = useRetweetsStore();

        const createRetweet = async () => {
            const res = await callApi('post', '/create_retweet', { tweet_id: props.tweet.id })

            if (res.status == 201) {
                retweetStore.add(props.tweet.id)
            }
            else {

            }
        }

        const deleteRetweet = async () => {

            const res = await callApi('post', '/delete_retweet', { tweet_id: props.tweet.id })

            if (res.status == 200) {
                retweetStore.remove(props.tweet.id)
            } else {

            }
        }

        const isRetweeted = computed(() => {
            return retweetStore.getRetweets.includes(parseInt(props.tweet.id))
        })



        return { createRetweet, deleteRetweet, isRetweeted }

    }
}

</script>

<style>
.tweet {
    background-color: black;
    color: whitesmoke;
    padding: 1rem;
    margin-bottom: 1rem;
}

.tweet .user_and_date {
    margin: 0rem 0rem 1rem 0rem;
    display: flex;
    justify-content: space-between;
}

.tweet .text {
    margin: 1.5rem 0rem 0.5rem 0rem;
}
</style>
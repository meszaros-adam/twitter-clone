<template>
    <div  :class="{retweet: tweet.retweet_id}">
        <div class="flex justify-space-between">
            <div v-if="tweet.retweet_id">
                Retweeted by {{ tweet.retweet_user_nickname }}
            </div>
            <div v-if="tweet.retweet_id">
                {{ tweet.retweet_created_at }}
            </div>
        </div>
        <div class="container tweet rounded">
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
                <div v-if="user">
                    <div v-if="user.id !== tweet.user_id">
                        <i v-if="!isRetweeted" @click="createRetweet" class="fa-solid fa-retweet" title="Retweet"></i>
                        <i v-if="isRetweeted" @click="deleteRetweet" class="fa-solid fa-retweet retweet-active"
                            title="Delete retweet"></i>
                    </div>
                </div>
                <div v-else>
                    <router-link to="/login">
                        <i class="fa-solid fa-retweet" title="Retweet"></i>
                    </router-link>
                </div>
                <i @click="$emit('commentButtonClicked')" class="fa-regular fa-comments" title="Comments"></i>
            </div>
        </div>
    </div>
</template>

<script>
import { computed, ref } from 'vue'
import callApi from '../composables/callApi'
import { useRetweetsStore } from '../stores/retweets'
import { useUserStore } from '../stores/user'
export default {
    props: ["tweet"],
    setup(props, context) {

        const tweet = ref(props.tweet)
        const retweetStore = useRetweetsStore();
        const user = useUserStore().getUser

        const createRetweet = async () => {
            const res = await callApi('post', '/create_retweet', { tweet_id: tweet.value.id })

            if (res.status == 201 || 200) {
                retweetStore.add(tweet.value.id)

                context.emit('retweetCreated', res.data)
            }
            else {

            }
        }

        const deleteRetweet = async () => {

            const res = await callApi('post', '/delete_retweet', { tweet_id: tweet.value.id })

            if (res.status == 200) {
                retweetStore.remove(tweet.value.id)

                if (tweet.value.retweet_id) {
                    context.emit('retweetRemoved', tweet.value.retweet_id)
                }
            } else {

            }
        }

        const isRetweeted = computed(() => {
            return retweetStore.getRetweets.includes(parseInt(tweet.value.id))
        })



        return { createRetweet, deleteRetweet, isRetweeted, tweet, user }

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

.retweet {
    background-color: rgb(29, 29, 29);
    color: whitesmoke;
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 10px;
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
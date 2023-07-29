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
            <i @click="retweet" class="fa-solid fa-retweet" title="Retweet"></i>
            <i class="fa-regular fa-comments" title="Comments"></i>
        </div>
    </div>
</template>

<script>
import callApi from '../../composables/callApi'
export default {
    props: ["tweet"],
    setup(props) {

        const retweet = async () => {
            const res = await callApi('post', '/create_retweet', {tweet_id: props.tweet.id})

            if (res.status == 201) {

            }
            else {

            }
        }

        return{ retweet}

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
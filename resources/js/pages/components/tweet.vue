<template>
    <div class="tweet rounded">
        <div class="user_and_date">
            <div>
                {{ tweet.user.nickname }}
            </div>
            <div>
                {{ tweet.created_at }}
            </div>

        </div>
        <hr>
        <div class="text">
            {{ tweet.text }}
        </div>
    </div>
</template>

<script>
export default {
    props: ["tweet"],
    setup() {

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
<template>
    <div class="tweet">
        <div class="user">
            {{ tweet.user.nickname }}
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
    border-radius: var(--borderRadius);
    margin-bottom: 1rem;
}

.tweet .user {
    margin: 0rem 0rem 1rem 0rem;
}

.tweet .text {
    margin: 1.5rem 0rem 0.5rem 0rem;
}
</style>
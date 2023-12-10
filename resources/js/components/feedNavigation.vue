<template>
    <div class="container">
        <div class="flex justify-space-around">
            <router-link to="/" class="feed-nav rounded">Feed</router-link>
            <router-link to="/all-tweets" class="feed-nav rounded">All Tweets</router-link>
        </div>
    </div>
</template>

<style scoped>
.feed-nav {
    background-color: var(--mainColor);
    padding: 10px;
}

.router-link-active {
    text-decoration: underline;
    font-weight: bolder;
}
</style>
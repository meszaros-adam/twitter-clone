<template>
    <div>
        <div class="modal">
            <div class="flex close-button">
                <button @click="$emit('closeModal')" class="button">
                    Close
                </button>
            </div>

            <tweetVue :tweet="tweet"></tweetVue>
        </div>
        <div @click="$emit('closeModal')" class="overlay"></div>
    </div>
</template>

<script>
import tweetVue from './tweet.vue';
export default {
    props: ["tweet"],
    components: { tweetVue },
    setup() {

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
    z-index: 1;
}

.modal {
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    position: fixed;
    top: 20%;
    z-index: 2;
}

.flex.close-button {
    justify-content: end;
    margin: 1rem;
}
</style>
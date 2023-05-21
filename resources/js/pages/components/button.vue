<template>
    <button class="button">
        <slot></slot>
    </button>
</template>


<script>
export default {
    setup() {

    }
}
</script>

<style scoped>
.button {
    background-color: var(--secondaryColor);
    padding: 7px;
    border-radius: 5px;
    border-style: none;
    border: solid 2px var(--secondaryColor);
    cursor: pointer;
    color: whitesmoke;
    transition: all 0.3s ease-in-out;
}

.button:hover {
    box-shadow: 0px 10px 10px -3px #111;    
    transform:translateY(-3px);
}
</style>
<template>
    <div v-if="text.length != 0" class="alert">
        {{ text }}
    </div>
</template>

<script>
export default {
    props: ["text"],
    setup(props) {

        //setTimeout(() => { alert.value = false }, 10000)

    }
}

</script>

<style>
.alert {
    background-color: #E74646;
    padding: 10px;
    margin-bottom: 2rem;
    border-radius: var(--borderRadius);
    color: black;
    font-weight: bold;
}
</style>
<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Login</h1>
            <div>
                <label for="nickname">Nickname:</label>
                <input type="text" id="nickname" name="nickname">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <buttonVue>Login</buttonVue>
        </div>
    </div>
</template>

<script>
import buttonVue from '../components/button.vue';

export default {
    components: { buttonVue },
}

</script>

<style></style>
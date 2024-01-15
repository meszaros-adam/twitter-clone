<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Login</h1>
            <div class="input-group">
                <label for="email">Email:</label>
                <input v-model="loginData.email" type="text" id="email" name="email">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input v-model="loginData.password" type="password" id="password" name="password">
            </div>
            <div class="flex">
                <button class="button" @click="login">Login</button>
                <label class="checkbox">
                    <input v-model="loginData.stayLoggedIn" type="checkbox">
                    Stay logged in
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import callApi from '../../composables/callApi';
import validateEmail from '../../composables/validateEmail';
import { useNotification } from "@kyvg/vue3-notification";
export default {
    setup() {

        const { notify } = useNotification()

        const loginData = ref({
            email: "",
            password: "",
            stayLoggedIn: false,
        })

        const login = async () => {
            if (!validateEmail(loginData.value.email.trim())) return notify({
                type: "warning",
                title: "Email",
                text: "Email must be a valid email!",
            });
            if (loginData.value.password.trim().length < 6) return notify({
                type: "warning",
                title: "Password",
                text: "Password must be at least 6 characters!",
            });

            const res = await callApi('post', '/auth/login', loginData.value)

            if (res.status == 200) {
                notify({
                    type: "success",
                    title: "Successful login!",
                });

                setTimeout(function () {
                    window.location.href = '/';
                }, 3000);

            } else {
                notify({
                    type: "error",
                    title: "Login failed",
                });
            }
        }

        return { loginData, login }
    }
}
</script>

<style scoped></style>
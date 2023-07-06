<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Login</h1>
            <alertVue :text="alertText"></alertVue>
            <div class="input-group">
                <label for="nickname">Email:</label>
                <input v-model="loginData.email" type="email" id="nickname" name="nickname">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input v-model="loginData.password" type="password" id="password" name="password">
            </div>
            <div class="flex">
                <button class="button button-auth" @click="login">Login</button>
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
import alertVue from '../components/alert.vue';
import callApi from '../../composables/callApi';
import validateEmail from '../../composables/validateEmail';
export default {
    components: { alertVue },

    setup() {
        const loginData = ref({
            email: "",
            password: "",
            stayLoggedIn: false,
        })

        const login = async () => {
            if (!validateEmail(loginData.value.email.trim())) return showAlert('Email must be a valid email!')
            if (loginData.value.password.trim().length < 6) return showAlert('Password must be at least 6 characters!')

            const res = await callApi('post', '/auth/login', loginData.value)

            if (res.status == 200) {
                window.location.href = '/';
            } else {
                console.log('Login failed!')
            }
        }

        const alertText = ref('')

        const showAlert = (text) => {
            alertText.value = text
        }


        return { loginData, alertText, login }
    }
}
</script>

<style scoped></style>
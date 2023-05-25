<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Login</h1>
            <div v-if="alert" class="alert">{{ alertText }}</div>
            <div class="input-group">
                <label for="nickname">Email:</label>
                <input v-model="loginData.email" type="email" id="nickname" name="nickname">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input v-model="loginData.password" type="password" id="password" name="password">
            </div>
            <div class="flex">
                <buttonVue @click="login">Login</buttonVue>
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
import buttonVue from '../components/button.vue';
import callApi from '../../composables/callApi';
import validateEmail from '../../composables/validateEmail';
export default {
    components: { buttonVue },

    setup() {
        const loginData = ref({
            email: "",
            password: "",
            stayLoggedIn: false,
        })

        const login = async () => {
            if (!validateEmail(loginData.value.email)) return showAlert('Email must be a valid email!')
            if (loginData.value.password.length < 6) return showAlert('Password must be at least 6 characters!')

            const res = await callApi('post', '/auth/login', loginData.value)

            if (res.status == 200) {
                window.location.href = '/';
            } else {
                return showAlert(res.data.message)
            }
        }

        const alert = ref(false)
        const alertText = ref('')

        const showAlert = (text) => {
            alert.value = true
            alertText.value = text

            //setTimeout(() => { alert.value = false }, 10000)
        }


        return { loginData, alert, alertText, login }
    }
}
</script>

<style scoped>

</style>
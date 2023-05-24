<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Login</h1>
            <div v-if="alert" class="alert">{{ alertText }}</div>
            <div>
                <label for="nickname">Email:</label>
                <input v-model="loginData.email" type="email" id="nickname" name="nickname">
            </div>
            <div>
                <label for="password">Password:</label>
                <input v-model="loginData.password" type="password" id="password" name="password">
            </div>
            <buttonVue @click="login">Login</buttonVue>
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
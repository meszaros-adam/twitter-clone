<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Register</h1>
            <div v-show="alert" class="alert">{{ alertText }}</div>
            <div class="input-group">
                <label for="nickname">Nickname:</label>
                <input v-model="registerData.nickname" type="text" id="nickname" name="nickname">
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input v-model="registerData.email" type="text" id="email" name="email">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input v-model="registerData.password" type="password" id="password" name="password">
            </div>
            <div class="input-group">
                <label for="password-confirmation">Password Confirmation:</label>
                <input v-model="registerData.password_confirmation" type="password" id="password-confirmation"
                    name="password-confirmation">
            </div>
            <buttonVue @click="registration">Regsiter</buttonVue>
        </div>
    </div>
</template>

<script>
import buttonVue from '../components/button.vue';
import { ref } from "vue";
import callApi from '../../composables/callApi';
import validateEmail from '../../composables/validateEmail'
export default {
    components: { buttonVue },
    setup() {
        const registerData = ref({
            nickname: '',
            email: '',
            password: '',
            password_confirmation: '',
        })

        const registration = async () => {

            if (registerData.value.nickname.length < 4) return showAlert('Nickname must be at least 4 characters!')
            if (!validateEmail(registerData.value.email)) return showAlert('Email must be a valid email!')
            if (registerData.value.password.length < 6) return showAlert('Password must be at least 6 characters!')
            if (registerData.value.password != registerData.value.password_confirmation) return showAlert('The passwords do not match!')

            const res = await callApi('post', '/auth/register', registerData.value)

            if (res.status == 201) {
                console.log('sucessfull registration')
            } else {
                console.log('registration failed')
            }
        }

        const alert = ref(false)
        const alertText = ref('')

        const showAlert = (text) => {
            alert.value = true
            alertText.value = text

            //setTimeout(() => { alert.value = false }, 10000)
        }

        return { registerData, registration, alert, alertText }
    }
}
</script>
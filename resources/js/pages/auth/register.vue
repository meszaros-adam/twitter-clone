<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Register</h1>
            <div>
                <label for="nickname">Nickname:</label>
                <input v-model="registerData.nickname" type="text" id="nickname" name="nickname">
            </div>
            <div>
                <label for="email">Email:</label>
                <input v-model="registerData.email" type="text" id="email" name="email">
            </div>
            <div>
                <label for="password">Password:</label>
                <input v-model="registerData.password" type="password" id="password" name="password">
            </div>
            <div>
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
export default {
    components: { buttonVue },

    setup() {
        const registerData = ref({
            nickname: '',
            email: '',
            password: '',
            password_confirmation: '',
        })

        const registration = () => {
            const res = callApi('post', '/auth/register', registerData.value)

            if (res.status == 201) {
                console.log('sucessfull registration')
            } else {
                console.log('registration failed')
            }
        }

        return { registerData, registration }
    }
}
</script>
<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Register</h1>
            <alertVue :text="alertText"></alertVue>
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
            <button class="button" @click="registration">Regsiter</button>
        </div>
    </div>
</template>

<script>
import alertVue from '../../components/alert.vue';
import { ref } from "vue";
import callApi from '../../composables/callApi';
import validateEmail from '../../composables/validateEmail'
import { useNotification } from "@kyvg/vue3-notification";
export default {
    components: { alertVue },
    setup() {

        const { notify } = useNotification()

        const registerData = ref({
            nickname: '',
            email: '',
            password: '',
            password_confirmation: '',
        })

        const registration = async () => {

            if (registerData.value.nickname.trim().length < 4) return notify({
                type: "error",
                title: "Nickname",
                text: "Nickname must be at least 4 characters!",
            });
            if (!validateEmail(registerData.value.email.trim())) return showAlert('Email must be a valid email!')
            if (registerData.value.password.trim().length < 6) return showAlert('Password must be at least 6 characters!')
            if (registerData.value.password != registerData.value.password_confirmation) return showAlert('The passwords do not match!')

            const res = await callApi('post', '/auth/register', registerData.value)

            if (res.status == 201) {
                console.log('Sucessfull registration!')
                window.location.href = '/login'
            } else {
                notify({
                    type: "error",
                    title: "Registration",
                    text: "Registration failed!",
                });
                console.log('Registration failed!')
            }
        }

        const alertText = ref('')

        const showAlert = (text) => {
            alertText.value = text

        }

        return { registerData, registration, alert, alertText }
    }
}
</script>
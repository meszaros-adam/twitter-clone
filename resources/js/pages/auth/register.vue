<template>
    <div class="container">
        <div class="auth-form container">
            <h1>Register</h1>
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
import { ref } from "vue";
import callApi from '../../composables/callApi';
import validateEmail from '../../composables/validateEmail'
import { useNotification } from "@kyvg/vue3-notification";
export default {
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
                type: "warning",
                title: "Nickname",
                text: "Nickname must be at least 4 characters!",
            });
            if (!validateEmail(registerData.value.email.trim())) return notify({
                type: "warning",
                title: "Email",
                text: "Email must be a valid email!",
            });
            if (registerData.value.password.trim().length < 6) return notify({
                type: "warning",
                title: "Nickname",
                text: "Password must be at least 6 characters!",
            });
            if (registerData.value.password != registerData.value.password_confirmation)
                return notify({
                    type: "warning",
                    title: "Password",
                    text: "The passwords do not match!",
                });

            const res = await callApi('post', '/auth/register', registerData.value)

            if (res.status == 201) {
                notify({
                    type: "success",
                    title: "Registration",
                    text: "Successful registration!",
                });


                setTimeout(function () {
                    window.location.href = '/login'
                }, 3000);
            } else {
                notify({
                    type: "error",
                    title: "Registration",
                    text: "Registration failed!",
                });
            }
        }

        return { registerData, registration }

    }
}
</script>
<template>
    <div>
        <div class="container">
            <div class="auth-form container">
                <h1>User Data Settings</h1>
                <alertVue :text="alertText"></alertVue>
                <div class="input-group">
                    <label for="nickname">Nickname:</label>
                    <input v-model="user.nickname" type="text" id="nickname" name="nickname">
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input v-model="user.email" type="text" id="email" name="email">
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input v-model="user.password" type="password" id="password" name="password">
                </div>
                <button class="button" @click="updateProfile">Update Profile</button>
            </div>
            <div class="auth-form container">
                <h1>Password Change</h1>
                <alertVue :text="alertText"></alertVue>
                <div class="input-group">
                    <label for="newPassword">New Password:</label>
                    <input v-model="newPassword" type="password" id="newPassword" name="newPassword">
                </div>
                <div class="input-group">
                    <label for="newPasswordConfirmation">New Password Confirmation:</label>
                    <input v-model="newPasswordConfirmation" type="password" id="newPasswordConfirmation"
                        name="newPasswordConfirmation">
                </div>
                <div class="input-group">
                    <label for="oldPassword">Old Password:</label>
                    <input v-model="oldPassword" type="password" id="oldPassword" name="oldPassword">
                </div>
                <button class="button" @click="updatePassword">Update Password</button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import alertVue from "../components/alert.vue";
import { useUserStore } from "../stores/user";
import callApi from '../composables/callApi';
import validateEmail from '../composables/validateEmail'
export default {
    components: { alertVue },
    setup() {

        const userStore = useUserStore()
        const alertText = ref('')
        const user = ref(userStore.getUser)


        const updateProfile = async () => {
            if (user.value.nickname.trim().length < 4) return console.log('Nickname must be at least 4 characters!')
            if (!validateEmail(user.value.email.trim())) return console.log('Email must be a valid email!')
            if (user.value.password.trim().length < 6) return console.log('Password must be at least 6 characters!')
            const res = await callApi('post', '/update_user', user.value)

            if (res.status == 200) {

            } else {

            }

        }

        const newPassword = ref('')
        const newPasswordConfirmation = ref('')
        const oldPassword = ref('')

        const updatePassword = async () => {
            if (newPassword.value.trim().length < 6) return console.log('Password must be at least 6 characters!')
            if (newPassword.value !== newPasswordConfirmation.value) return console.log('Passwords must be at the same!')
            if (oldPassword.value.trim().length < 6) return console.log('Password must be at least 6 characters!')
            const res = await callApi('post', '/update_user', {
                new_password: newPassword.value,
                new_password_confirmation: newPasswordConfirmation.value,
                old_password: oldPassword.value
            })

            if (res.status == 200) {

            }
            else {

            }
        }

        return { alertText, user, updateProfile, newPassword, newPasswordConfirmation, oldPassword, updatePassword }
    }
}
</script>
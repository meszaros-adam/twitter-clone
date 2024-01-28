<template>
    <div>
        <div class="container">
            <div class="auth-form container">
                <h1>User Data Settings</h1>
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
import { useUserStore } from "../stores/user";
import callApi from '../composables/callApi';
import validateEmail from '../composables/validateEmail'
import { useNotification } from "@kyvg/vue3-notification";
export default {
    setup() {

        const userStore = useUserStore()
        const { notify } = useNotification()

        const user = ref({
            nickname: userStore.getUser.nickname,
            email: userStore.getUser.email,
            password: userStore.getUser.password,
        })


        const updateProfile = async () => {
            if (user.value.nickname.trim().length < 4) return notify({
                type: 'warning',
                title: 'Nickname',
                text: 'Nickname must be at least 4 characters!',
            })
            if (!validateEmail(user.value.email.trim())) return notify({
                type: 'warning',
                title: 'Email',
                text: 'Email must be a valid email!',
            })
            if (user.value.password.trim().length < 6) return notify({
                type: 'warning',
                title: 'Password',
                text: 'Password must be at least 6 characters!',
            })

            const res = await callApi('post', '/update_user', user.value)

            if (res.status == 200) {

                //this part isnt working yet
                console.log(res.data)
                userStore.add(res.data)
            } else {

            }

        }

        const newPassword = ref('')
        const newPasswordConfirmation = ref('')
        const oldPassword = ref('')

        const updatePassword = async () => {
            if (newPassword.value.trim().length < 6) return notify({
                type: 'warning',
                title: 'Password',
                text: 'Password must be at least 6 characters!',
            })
            if (newPassword.value !== newPasswordConfirmation.value) return notify({
                type: 'warning',
                title: 'Password',
                text: 'Passwords must be at the same!',
            })
            if (oldPassword.value.trim().length < 6) return notify({
                type: 'warning',
                title: 'Password',
                text: 'Old password must be at least 6 characters!',
            })

            const res = await callApi('post', '/update_password', {
                new_password: newPassword.value,
                new_password_confirmation: newPasswordConfirmation.value,
                old_password: oldPassword.value
            })

            if (res.status == 200) {
                window.location = '/login';
            }
            else {

            }
        }

        return { user, updateProfile, newPassword, newPasswordConfirmation, oldPassword, updatePassword }
    }
}
</script>
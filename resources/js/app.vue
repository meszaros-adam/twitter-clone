<template>
    <div class="wrapper">
        <header>
            <router-link to="/" class="flex">
                <h1>Twitter Clone</h1>
                <img src="../../storage/app/images/bird-icon.png" alt="">
            </router-link>
            <div class="auth">
                <div v-if="user">
                    <div>{{ user.nickname }}</div>
                    <a href="/auth/logout">Logout</a>
                </div>
                <div v-else>
                    <div>
                        <router-link to="/login">Login</router-link>
                    </div>
                    <div>
                        <router-link to="/register">Register</router-link>
                    </div>
                </div>
            </div>
        </header>
        <section class="content">
            <router-view></router-view>
        </section>
        <footer>
            Twitter Clone &copy; Mészáros Ádám 2023
        </footer>
    </div>
</template>

<script>
export default {
    props: ["user"],
    setup(props) {
        const user = props.user

        return { user }
    }
}
</script>

<style></style>
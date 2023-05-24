<template>
    <div class="wrapper">

        <header>

            <router-link to="/" class="flex">
                <h1>Twitter Clone</h1>
                <img src="../../storage/app/images/bird-icon.png" alt="">
            </router-link>


            <div class="auth">
                <div>
                    <router-link to="/login">Login</router-link>
                </div>
                <div>
                    <router-link to="/register">Register</router-link>
                </div>
                <div> Logout</div>
            </div>
        </header>
        <section class="content">
            <router-view></router-view>
        </section>
        <footer>
            Twitter Clone &copy; 2023
        </footer>
    </div>
</template>

<script>
export default {
    setup() {

    }
}
</script>

<style></style>
<template>
    <div class="wrapper">
        <header>
            <h1>Twitter Clone</h1>
            <img src="../../storage/app/images/bird-icon.png" alt="">
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

<style>
/* CSS reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* CSS reset */

/* Utility classes */
.container {
    margin: 2rem;
    padding: 2rem;
}

/* Utility classes */

/* Stick footer on bottom */
.wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background-color: #2C3333;
}

footer {
    margin-top: auto;
    background-color: black;
    color: whitesmoke;
    padding: 0.5rem;
    display: flex;
    justify-content: center;
}

/* Stick footer on bottom */

/* Others */
header {
    background-color: #19A7CE;
    padding: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
}

header img {
    height: 3em;
}

.auth {
    position: absolute;
    right: 1rem;
}
</style>
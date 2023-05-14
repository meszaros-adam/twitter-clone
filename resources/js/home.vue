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

/* Variables */
:root {
    --mainColor: #19A7CE;
    --secondaryColor: #146C94;
    --backgroundColor: #2C3333;
    --borderRadius: 10px
}

/* Variables */

/* Utility classes */
.container {
    margin: 1rem 0.5rem 1rem 0.5rem;
    padding: 0.5rem;
}

.button {
    background-color: var(--secondaryColor);
    padding: 5px;
    border-radius: 3px;
    border-style: none;
    border: solid 2px var(--secondaryColor);
    cursor: pointer;
    color: whitesmoke;
    transition: all 0.3s ease-in-out;
}

.button:hover {
    border: solid 2px black;
    box-shadow: 2px 2px 5px black;
}

/* Utility classes */


/* Stick footer on bottom */
.wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background-color: var(--backgroundColor);
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
    background-color: var(--mainColor);
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

.auth-form {
    background-color: var(--mainColor);
    border-radius: var(--borderRadius);
}

.auth-form h1 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

label {
    display: block;
}

input {
    width: 100%;
    height: 2rem;
    margin: 1rem 0rem 1rem 0rem;
    padding: 5px;
    border-style: none;
    border-radius: 5px;
}

/* Media Querries */
@media only screen and (min-width: 600px) {
    .container {
        margin: 2rem;
        padding: 2rem;
    }
}

/* Media Querries */</style>
import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Home from './Home.vue';
import router from './router'

const app = createApp({});

app.use(router)

app.component('home-component', Home);

app.mount("#app");
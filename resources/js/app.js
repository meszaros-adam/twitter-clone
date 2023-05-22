import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import App from './app.vue';
import router from './router'

const app = createApp({});

app.use(router)

app.component('app', App);

app.mount("#app");
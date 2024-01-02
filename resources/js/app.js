import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import { createPinia } from 'pinia'
import App from './app.vue';
import router from './router'
import Notifications from '@kyvg/vue3-notification'

const app = createApp({});
const pinia = createPinia()

app.use(router)
app.use(pinia)
app.use(Notifications)

app.component('app', App);
app.mount("#app");
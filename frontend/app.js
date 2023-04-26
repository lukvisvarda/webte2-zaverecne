import './bootstrap';
/* eslint-disable no-unused-vars */
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store';



const app = createApp(App);
app.use(store);
app.use(router);
app.mount('#app');

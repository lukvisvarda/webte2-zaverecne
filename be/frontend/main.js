/* eslint-disable no-unused-vars */
require('./bootstrap');
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store';
import Latex from "./components/latex/Latex.vue"



const app = createApp(App);
app.use(store);
app.use(Latex);
app.use(router);
app.mount('#app');

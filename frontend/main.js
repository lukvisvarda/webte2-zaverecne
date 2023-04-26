/* eslint-disable no-unused-vars */
require('./bootstrap');
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store';
import Latex from "./components/latex/Latex.vue"
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import VueGoodTablePlugin from 'vue-good-table-next';

// import the styles
import 'vue-good-table-next/dist/vue-good-table-next.css'

const app = createApp(App);
app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true,
})
app.use(store);
app.use(Latex);
app.use(router);
app.use(VueGoodTablePlugin);
app.mount('#app');

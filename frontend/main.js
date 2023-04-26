/* eslint-disable no-unused-vars */
require('./bootstrap');
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store';
import Latex from "./components/latex/Latex.vue"
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
import routerAuth from './router-auth';


const app = createApp(App);
app.use(store);
app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true,
})
routerAuth(router);
app.use(router);
store.dispatch('init').then(() => {
  console.log("after init");
    // app.mount('#app');
});
// app.mount('#app');

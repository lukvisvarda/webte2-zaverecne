/* eslint-disable no-unused-vars */

require('./bootstrap');
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store';
import Latex from "./components/latex/Latex.vue"
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import JsonCSV from 'vue-json-csv'


// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
// Optionally install the BootstrapVue icon components plugin


const app = createApp(App);
app.component('downloadCsv', JsonCSV)
// app.use(BootstrapVue)
// app.use(IconsPlugin)
app.use(store);
app.use(Latex);
app.use(Toast, {
  transition: "Vue-Toastification__bounce",
  maxToasts: 20,
  newestOnTop: true,
});


console.log("start")

// async function init(){
//   await store.dispatch('init');
//   app.mount('#app');
// }
// await init();
store.dispatch('init').then(() => {
  console.log("aoijsdoasjdoasjdoas", store.getters.getUser);
  app.use(router);
  app.mount('#app');
  console.log("After login")
});

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

import { createI18n } from "vue-i18n";

function loadLocaleMessages() {
  const locales = require.context('./locales', true, /[A-Za-z0-9-_,\s]+\.js$/i);
  const messages = {};
  locales.keys().forEach((key) => {
    const matched = key.match(/([A-Za-z0-9-_]+)\./i);
    if (matched && matched.length > 1) {
      const locale = matched[1];
      messages[locale] = locales(key).default;
    }
  });
  return messages;
}

const i18n = createI18n({
  legacy: true,
  locale: 'sk',
  messages: loadLocaleMessages()
});

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
app.use(i18n);

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

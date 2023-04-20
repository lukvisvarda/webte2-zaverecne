/* eslint-disable no-unused-vars */
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Auth from './context/auth';
import api from './utils/api';
import { AUTH_ME } from './constants/edpoints';



const app = createApp(App);
app.config.globalProperties.$auth = Auth;

app.mixin({
  created(){
    const token = localStorage.getItem("accessToken");
    if(token){
      api.get(AUTH_ME).then(response =>{
        Auth.user = response.data;
        console.log(response);
      }).catch(err=>{
        console.error(err);
      });
    }
  }
});

app.use(router);
app.mount('#app');




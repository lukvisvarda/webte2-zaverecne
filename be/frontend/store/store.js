import AuthService from "../services/auth.service";
import axios from 'axios';
import { createStore } from 'vuex'
import AppService from "../services/app.service";

export default createStore({
  state:{
    loggedIn: false,
    user: null
  },
  mutations:{
    login(state, user){
      state.loggedIn = true;
      state.user = user;
      AppService.setToken(token)
    },
    logout(state){
      state.loggedIn = false;
      state.user = null;
    }
  },
  actions:{
    async login({ commit }, user){
      console.log("SOM TU ")
      try{
        const response = await AuthService.login(user);
        console.log("ResponseToken", response.token)
        AppService.setToken(response.token);
        commit('login', user);

      }catch(err){
        console.log("err");
      }
      // axios.post("http://127.0.0.1:8000/api/auth/login",{email: "teacher@example.com", password: "pass123"}).then(response =>{
      //   response.data
      //   console.log('wtf is this shote');
      // });
    },

    logout({ commit }) {

      commit('logout');
    },
  },
  getters:{
    isLoggedIn: state => state.loggedIn,
    getUser: state => state.user,
  }
})

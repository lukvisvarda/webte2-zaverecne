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
        return true;
      }catch(err){
        console.log("err");
        return false;
      }
    },

    logout({ commit }) {
      commit('logout');
    },

    async init({ commit }){
      const token = AppService.getToken();
      console.log("tokeniiiiiik", token)
      if(token){
        const user = await AuthService.me();
        if(user) commit('login', user);
        else AppService.clearToken();
      }
    }
  },
  getters:{
    isLoggedIn: state => state.loggedIn,
    getUser: state => state.user,
  }
})

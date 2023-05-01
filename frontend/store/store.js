import AuthService from "../services/auth.service";
import axios from 'axios';
import { createStore } from 'vuex'
import AppService from "../services/app.service";

export default createStore({
  state:{
    loggedIn: false,
    user: null,
    authErrors: [],
  },
  mutations:{
    login(state, user){
      state.loggedIn = true;
      state.user = user;
    },
    logout(state){
      state.loggedIn = false;
      state.user = null;
    },
    register(state, user) {
      state.loggedIn = true;
      state.user = user;
      state.authErrors = [];
    },
    setAuthErrors(state, errors) {
      state.authErrors = errors;
    }
  },
  actions:{
    async login({ commit }, user){
      console.log("SOM TU ")
      try{
        const response = await AuthService.login(user);
        console.log("ResponseToken", response.token)
        AppService.setToken(response.token);
        commit('login', response.user);
        return true;
      }catch(err){
        console.log("err");
        return false;
      }
    },

    async register({ commit }, user){
      try {
        const response = await AuthService.register(user);
        AppService.setToken(response.token);
        commit('register', response.user);
        return true;
      } catch(error){
        if (error.response.status === 422) {
          commit('setAuthErrors', error.response.data.errors);
        }
        return false;
      }
    },

    logout({ commit }) {

      AppService.clearToken();
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
    getAuthErrors: state => state.authErrors,
  }
})

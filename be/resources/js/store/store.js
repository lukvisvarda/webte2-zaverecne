import AuthService from "../services/auth.service";
import axios from 'axios';
import { createStore } from 'vuex'

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
      const response = await AuthService.login(user);
      // axios.post("http://127.0.0.1:8000/api/auth/login",{email: "teacher@example.com", password: "pass123"}).then(response =>{
      //   response.data
      //   console.log('wtf is this shote');
      // });
      console.log("Response", response.data)
      commit('login', user);
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

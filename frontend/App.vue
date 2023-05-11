<template>
  <div>
    <layout v-if="isLoggedIn"></layout>
    <RouterView></RouterView>
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import Login from './components/login/Login.vue';
import Layout from "./components/Layout.vue";
import {useStore} from "vuex";

export default {
  name: 'App',
  setup(){
    const store = useStore();
    return{
      store,
    }
  },
  computed: {
    isLoggedIn(){
      return this.store.getters.isLoggedIn;
    }
  },

  components: {
    Layout,
    HelloWorld,
    Login
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>

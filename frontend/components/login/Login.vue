
<template>
  <form @submit.prevent="onSubmit">
    <div class="full-page">

      <div class="form-wrapper">
        <label for="email">Email</label>
        <input class="form-control" type="email" placeholder="E-mail" id="email" v-model="email">
        <div v-if="emailError" class="text-danger">{{ emailError }}</div>

        <label for="password">Heslo</label>
        <input class="form-control" type="password" placeholder="Heslo" id="password" v-model="password">
        <div v-if="passwordError" class="text-danger">{{ passwordError }}</div>

        <input type="submit" class="btn btn-primary"/>
      </div>
    </div>

    <latex :str="this.latexKokotina"></latex>
    <task></task>
  </form>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css';
import { useStore } from 'vuex';
import Latex from '../latex/Latex.vue';
import Task from "../latex/Task.vue";
import { useToast } from "vue-toastification";

export default{

  name: 'LoginForm',
  components:{
    Latex,
    Task
  },
  computed:{
    formInvalid() {
      return this.nameError || this.emailError || !this.name || !this.email
    },
  },

  setup(){
    const store = useStore();

    return {
      isLoggedIn: store.getters.isLoggedIn,
      login: (user) => store.dispatch('login', user),
    }
  },

  data() {
    return{
      email: "",
      password: '',
      emailError: '',
      passwordError: '',
      latexKokotina: "\\dfrac{10}{20}",
      loginSuccess: false,
    }
  },
  methods: {
    async onSubmit() {
      const toast = useToast();
      const loginDto = {
        email: this.email,
        password: this.password,
      }
      // console.log(loginDto);

      // const response = await api.post(AUTH_LOGIN, loginDto);
      // console.log(response)
      // console.log(this.getIsLoggedIn);
      // const response = await this.login(loginDto);
      //   console.log(response);
      //   const a = await api.get(AUTH_ME);
      //   console.log(a);
      this.loginSuccess = await this.login(loginDto);
      if(this.loginSuccess){
        //TODO:
      } else {
        console.log("Wrong credentials")
        toast.error("Wrong credentials")
      }

    },
    validatePassword() {
      if (!this.password) {
        this.passwordError = 'Pass is required'
      } else {
        this.passwordError = ''
      }
    },
    validateEmail() {
      if (!this.email) {
        this.emailError = 'Email is required'
      } else if (!/\S+@\S+\.\S+/.test(this.email)) {
        this.emailError = 'Invalid email address'
      } else {
        this.emailError = ''
      }
    }
  },

  watch: {
    email: 'validateEmail',
    password: 'validatePassword'
  }
}
</script>

<style>
.form-wrapper{
  text-align: left;
  background: aliceblue;
  padding: 16px 32px;
  border-radius: 8px;
}

.full-page{
  height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn{
  margin-top: 8px;
}
</style>

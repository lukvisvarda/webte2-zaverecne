<template>
  <form @submit.prevent="onSubmit">
    <div class="full-page">
      <div class="form-wrapper">
        <label for="email">Email</label>
        <input
          class="form-control"
          type="email"
          placeholder="E-mail"
          id="email"
          v-model="email"
        />
        <div v-if="emailError" class="text-danger">{{ emailError }}</div>

        <label for="password">Heslo</label>
        <input
          class="form-control"
          type="password"
          placeholder="Heslo"
          id="password"
          v-model="password"
        />
        <div v-if="passwordError" class="text-danger">{{ passwordError }}</div>

        <input type="submit" class="btn btn-primary" />
      </div>
    </div>
  </form>
</template>

<script>
import "bootstrap/dist/css/bootstrap.css";
import { useStore } from "vuex";
import api from "../../utils/api"; //TODO: UNCOMMENT

export default {
  name: "LoginForm",
  computed: {
    formInvalid() {
      return this.nameError || this.emailError || !this.name || !this.email;
    },
  },

  setup() {
    const store = useStore();

    return {
      isLoggedIn: store.getters.isLoggedIn,
      login: (user) => store.dispatch("login", user),
    };
  },

  data() {
    return {
      email: "",
      password: "",
      emailError: "",
      passwordError: "",
    };
  },
  methods: {
    onSubmit() {
      const loginDto = {
        email: this.email,
        password: this.password,
      };
      console.log(loginDto);
      console.log(this.getIsLoggedIn);
      this.login(loginDto);
    },
    validatePassword() {
      if (!this.password) {
        this.passwordError = "Pass is required";
      } else {
        this.passwordError = "";
      }
    },
    validateEmail() {
      if (!this.email) {
        this.emailError = "Email is required";
      } else if (!/\S+@\S+\.\S+/.test(this.email)) {
        this.emailError = "Invalid email address";
      } else {
        this.emailError = "";
      }
    },
  },

  watch: {
    email: "validateEmail",
    password: "validatePassword",
  },
};
</script>

<style>
.form-wrapper {
  text-align: left;
  background: aliceblue;
  padding: 16px 32px;
  border-radius: 8px;
}

.full-page {
  height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn {
  margin-top: 8px;
}
</style>

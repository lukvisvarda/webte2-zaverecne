<template>
  <form @submit.prevent="onSubmit">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">
                  Please enter your login and password!
                </p>
                <div class="form-outline form-white mb-4">
                  <input
                    type="email"
                    id="email"
                    v-model="email"
                    class="form-control form-control-lg"
                    placeholder="Email"
                  />
                </div>
                <div v-if="emailError" class="text-danger">
                  {{ emailError }}
                </div>

                <div class="form-outline form-white mb-4">
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="password"
                    v-model="password"
                    placeholder="Password"
                  />
                </div>
                <div v-if="passwordError" class="text-danger">
                  {{ passwordError }}
                </div>

                <button class="btn btn-outline-light btn-lg px-5" type="submit">
                  Login
                </button>
              </div>

              <div>
                <p class="mb-0">
                  Don't have an account?
                  <router-link to="/register" class="text-white-50 fw-bold"
                    >Sign Up</router-link
                  >
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import "bootstrap/dist/css/bootstrap.css";
import { useStore } from "vuex";
import Latex from "../latex/Latex.vue";
import Task from "../latex/Task.vue";
import { useToast } from "vue-toastification";
import { useRouter } from "vue-router";

export default {
  name: "LoginForm",
  components: {
    Latex,
    Task,
  },
  computed: {
    formInvalid() {
      return this.nameError || this.emailError || !this.name || !this.email;
    },
  },

  setup() {
    const store = useStore();
    const router = useRouter();
    const toast = useToast();

    return {
      isLoggedIn: store.getters.isLoggedIn,
      login: (user) => store.dispatch("login", user),
      redirect: (to) => router.push(to),
      toast: function (msg) {
        toast.error(msg);
      },
    };
  },

  data() {
    return {
      email: "",
      password: "",
      emailError: "",
      passwordError: "",
      loginSuccess: false,
    };
  },
  methods: {
    async onSubmit() {
      // const toast = useToast();
      const loginDto = {
        email: this.email,
        password: this.password,
      };
      // console.log(loginDto);

      // const response = await api.post(AUTH_LOGIN, loginDto);
      // console.log(response)
      // console.log(this.getIsLoggedIn);
      // const response = await this.login(loginDto);
      //   console.log(response);
      //   const a = await api.get(AUTH_ME);
      //   console.log(a);
      this.loginSuccess = await this.login(loginDto);
      if (this.loginSuccess) {
        await this.redirect("/");
      } else {
        console.log("Wrong credentials");
        this.toast("Wrong credentials");
      }
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

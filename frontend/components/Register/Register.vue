<template>
  <form @submit.prevent="onSubmit">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                <p class="text-white-50 mb-5">Please enter your credentials!</p>

                <div class="form-outline form-white mb-4">
                  <input
                    type="text"
                    id="name"
                    v-model="userData.name"
                    class="form-control form-control-lg"
                    placeholder="Name"
                  />
                </div>
                <div v-if="this.errors.name" class="text-danger">
                  {{ this.errors.name[0] }}
                </div>

                <div class="form-outline form-white mb-4">
                  <input
                    type="email"
                    id="email"
                    v-model="userData.email"
                    class="form-control form-control-lg"
                    placeholder="Email"
                  />
                </div>
                <div v-if="this.errors.email" class="text-danger">
                  {{ this.errors.email[0] }}
                </div>

                <div class="form-outline form-white mb-4">
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="password"
                    v-model="userData.password"
                    placeholder="Password"
                  />
                </div>
                <div v-if="this.errors.password" class="text-danger">
                  {{ this.errors.password[0] }}
                </div>

                <div class="form-outline form-white mb-4">
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="password_confirmation "
                    v-model="userData.password_confirmation"
                    placeholder="Potvrd heslo"
                  />
                </div>
                <div v-if="passwordError" class="text-danger">
                  {{ passwordError }}
                </div>
                <div class="form-outline form-white mb-4">
                  <input
                    type="text"
                    id="ais_id"
                    v-model="userData.aisId"
                    class="form-control form-control-lg"
                    placeholder="AIS ID"
                  />
                </div>

                <div class="form-outline form-white mb-4">
                  <select
                    v-model="userData.role"
                    class="form-select form-select my-3"
                    aria-label=".form-select-sm example"
                  >
                    <option selected>Vyber rolu</option>
                    <option value="student">Študent</option>
                    <option value="teacher">Učiteľ</option>
                  </select>
                </div>
                <div v-if="this.errors.role" class="text-danger">
                  {{ this.errors.role[0] }}
                </div>

                <button class="btn btn-outline-light btn-lg px-5" type="submit">
                  Register
                </button>
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
import { mapGetters, mapActions } from "vuex";
import { useToast } from "vue-toastification";
import store from "../../store/store";

export default {
  name: "RegistrationForm",
  data() {
    return {
      userData: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        role: "Vyber rolu",
        aisId: "",
      },
      errors: {},
    };
  },
  computed: {
    ...mapGetters(["isLoggedIn"]),
  },
  methods: {
    ...mapActions(["register"]),

    onSubmit() {
      this.register(this.userData)
        .then((response) => {
          if (response) {
            this.redirect("/");
            this.toast("Registration was successful");
          } else {
            this.errors = store.getters.getAuthErrors;
            this.errToast("Something went wrong");
          }
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    redirect(to) {
      this.$router.push(to);
    },
    errToast(msg) {
      useToast().error(msg);
    },
    toast(msg) {
      useToast().success(msg);
    },
  },
};
</script>

<style>
.text-danger {
  margin-bottom: 5px;
}

.btn {
  margin-top: 8px;
}
</style>

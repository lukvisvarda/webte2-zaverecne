<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link
              to="/navod"
              class="nav-link"
            >
              {{ $t('navbar.tutorial') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link"
              to="/login"
              v-if="!this.isLoggedInComputed"
            >
              {{ $t('navbar.login') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              v-if="store.getters.getUser.role === 'teacher'"
              class="nav-link"
              to="/insert"
            >
              {{ $t('auth.teacher') }}
            </router-link>
          </li>

          <li class="nav-item">
            <router-link
              v-if="store.getters.getUser.role === 'student'"
              to="/student"
              class="nav-link"
            >
              {{ $t('auth.student') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/overview-teacher" class="nav-link">
              {{ $t('navbar.overviewTeacher') }}
            </router-link>
          </li>
        </ul>
        <form class="mb-2">
          <button
            class="btn btn-outline-success"
            type="submit"
            v-on:click="handleLogout"
            v-if="isLoggedInComputed"
          >
            {{ $t('navbar.logout') }}
          </button>
        </form>
        <language-switcher></language-switcher>
      </div>

    </div>
  </nav>
</template>

<script>
import { useStore } from "vuex";
import { useRouter } from "vue-router";
//import bootstrap classes used above
import LanguageSwitcher from "./LanguageSwitcher.vue";

export default {
  name: "Layout",
  components: {LanguageSwitcher},
  setup() {
    const store = useStore();
    const router = useRouter();

    console.log("isloggedin", store.getters.isLoggedIn);
    return {
      store,
      isLoggedIn: store.getters.isLoggedIn,
      logout: () => store.dispatch("logout"),
      redirect: (to) => router.push(to),
    };
  },

  computed: {
    isLoggedInComputed() {
      return this.store.getters.isLoggedIn;
    },
  },

  methods: {
    handleLogout() {
      this.logout();
      this.redirect("/");
    },
  },
};
</script>

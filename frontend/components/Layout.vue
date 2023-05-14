<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <router-link class="nav-link" to="/login" v-if="!this.isLoggedInComputed">
            {{ $t('navbar.login') }}
          </router-link>
          <router-link class="nav-link" to="/insert">
            {{ $t('auth.teacher') }}
          </router-link>
          <router-link to="/student"  class="nav-link">
            {{ $t('auth.student') }}
          </router-link>
          <router-link to="/overview-teacher"  class="nav-link">
            {{ $t('navbar.overviewTeacher') }}
          </router-link>
          <router-link to="/register"  class="nav-link">
            {{ $t('navbar.register') }}
          </router-link>
          <button class="nav-link" v-on:click="handleLogout" v-if="isLoggedInComputed">{{ $t('navbar.logout') }}</button>
        </div>
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

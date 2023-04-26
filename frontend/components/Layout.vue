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
            login
          </router-link>
          <router-link class="nav-link" to="/latex">
            latex
          </router-link>
          <router-link class="nav-link" to="/insert">
            insert
          </router-link>
          <button class="nav-link" v-on:click="handleLogout" v-if="isLoggedInComputed">logout</button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { useStore } from "vuex";
import { useRouter } from "vue-router";
//import bootstrap classes used above


export default {
  name: "Layout",
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

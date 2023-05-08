<template>
  <form @submit.prevent="onSubmit">
    <div class="full-page">

      <div class="form-wrapper">
        <label for="name">Name</label>
        <input class="form-control" type="text" id="name" v-model="userData.name">
        <div v-if="this.errors.name" class="text-danger">{{ this.errors.name[0] }}</div>

        <label for="email">Email</label>
        <input class="form-control" type="email" id="email" v-model="userData.email">
        <div v-if="this.errors.email" class="text-danger">{{ this.errors.email[0] }}</div>

        <label for="password">Heslo</label>
        <input class="form-control" type="password" id="password" v-model="userData.password">
        <div v-if="this.errors.password" class="text-danger">{{ this.errors.password[0] }}</div>

        <label for="password_confirmation ">Potvrd Heslo</label>
        <input class="form-control" type="password" id="password_confirmation " v-model="userData.password_confirmation ">

        <select v-model="userData.role" class="form-select form-select my-3" aria-label=".form-select-sm example">
          <option selected>Vyber rolu</option>
          <option value="student">Študent</option>
          <option value="teacher">Učiteľ</option>
        </select>
        <div v-if="this.errors.role" class="text-danger">{{ this.errors.role[0] }}</div>

        <input type="submit" value="Zaregistrovať" class="btn btn-primary"/>
      </div>
    </div>
  </form>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css';
import { mapGetters, mapActions } from 'vuex';
import { useToast } from 'vue-toastification';
import store from "../../store/store";

export default {
  name: 'RegistrationForm',
  data() {
    return {
      userData: {
        name: '',
        email: '',
        password: '',
        password_confirmation : '',
        role: 'Vyber rolu'
      },
      errors: {}
    }
  },
  computed: {
    ...mapGetters(['isLoggedIn']),
  },
  methods: {
    ...mapActions(['register']),

    onSubmit() {
      this.register(this.userData)
        .then(response => {
          if (response) {
            this.redirect('/');
            this.toast('Registration was successful');
          } else {
            this.errors = store.getters.getAuthErrors;
            this.errToast('Something went wrong');
          }
        })
        .catch(errors => {
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
    }
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

// import VueRouter from 'vue-router'
import { createRouter, createWebHistory } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Login from './components/login/Login.vue'

// Vue.use(VueRouter);

const routes = [
  { path: '/', component: HelloWorld },
  { path: '/login', component: Login}
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router;
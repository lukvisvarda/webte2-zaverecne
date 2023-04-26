// import VueRouter from 'vue-router'
import { createRouter, createWebHashHistory } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Login from './components/login/Login.vue'
import Latex from "./components/latex/Latex.vue"
import Task from "./components/latex/Task.vue";

// Vue.use(VueRouter);

const routes = [
  { path: '/', component: HelloWorld },
  { path: '/login', component: Login},
  {
      path: '/latex',
      component: Task,
      meta:{
          requiresAuth: true
      }
  }
];

const router = createRouter({
  base: "/",
  history: createWebHashHistory(),
  routes
});

export default router;

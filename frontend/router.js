// import VueRouter from 'vue-router'
import { createRouter, createWebHashHistory } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Login from './components/login/Login.vue'
import Latex from "./components/latex/Latex.vue"
import Task from "./components/latex/Task.vue";
import Insert from "./components/teacher/InsertLatex.vue";
import store from './store/store';

// Vue.use(VueRouter);

const routes = [
  { path: '/', component: HelloWorld },
  { path: '/login', component: Login},
  {
      path: '/latex',
      // component: Task,
      meta:{
          requiresAuth: true
      }
  },
  {
      path: '/insert', component: Insert,
  }
];

const router = createRouter({
  base: "/",
  history: createWebHashHistory(),
  routes
});

router.beforeEach((to, from, next) => {

  // console.log(store)
  const loggedIn = store.getters.getUser;

  console.log("loggedIn", loggedIn);
  // const loggedIn = localStorage.getItem('user');
  // Check if the route requires authentication
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // If the user is not authenticated, redirect to the login page
    if (!loggedIn) {
      next({
        path: '/login',
        query: { redirect: to.fullPath } // Save the current route for later redirect after login
      })
    } else {
      next() // Proceed to the requested route
    }
  } else {
    next() // Proceed to the requested route
  }
})

export default router;

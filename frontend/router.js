// import VueRouter from 'vue-router'
import { createRouter, createWebHashHistory } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Login from './components/login/Login.vue'
import Register from './components/Register/Register.vue'
import Latex from "./components/latex/Latex.vue"
import Task from "./components/latex/Task.vue";
import Insert from "./components/teacher/InsertLatex.vue";
import store from './store/store';
import StudentsPage from "./components/student/StudentsPage.vue";
import Overview from "./components/teacher/overview/Overview.vue";
import StudentOverview from "./components/teacher/overview/StudentOverview.vue";
import SingleProblem from "./components/student/SingleProblem.vue";
import Tutorial from "./components/tutorial/Tutorial.vue";

// Vue.use(VueRouter);

const routes = [
  { path: '/', component: HelloWorld },
  { path: '/login', component: Login, meta: { requiresNotAuth: true } },
  { path: '/register', component: Register, meta: { requiresNotAuth: true } },
  {
      path: '/latex',
      // component: Task,
      meta:{
          requiresAuth: true
      }
  },
  {
      path: '/insert', component: Insert, meta: { requiresAuth: true, requiresTeacher: true }
  },
  {
    path: '/student', component: StudentsPage, meta: { requiresAuth: true, requiresTeacher: false }
  },
  {
    path: '/overview-teacher', component: Overview, meta: { requiresAuth: true, requiresTeacher: true }
  },
  {
    path: '/overview-student', component: Latex, meta: { requiresAuth: true, requiresTeacher: true }
  },
  {
    path: "/teacher/student/:id", component:StudentOverview, meta: { requiresAuth: true, requiresTeacher: true }
  },
  {
    path: "/students/problem/:id", component: SingleProblem, meta: {requiresAuth: true, requiresTeacher: false}
  },
  {
    path: '/navod', component: Tutorial, meta: {requiresAuth: true}
  },
  {
    path: "/students/problem/:id", component:SingleProblem, meta: { requiresAuth: true, requiresTeacher: false }
  }
];

const router = createRouter({
  base: "/",
  history: createWebHashHistory(),
  routes
});

//authGuard
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

//role guard
router.beforeEach((to, from, next) => {

  // console.log(store)
  const loggedIn = store.getters.getUser;

  // const loggedIn = localStorage.getItem('user');
  // Check if the route requires authentication
  if (to.matched.some(record => record.meta.requiresNotAuth)) {
    // If the user is not authenticated, redirect to the login page
    if (loggedIn) {
      next({
        path: '/',
        query: { redirect: to.fullPath } // Save the current route for later redirect after login
      })
    } else {
      next() // Proceed to the requested route
    }
  } else {
    next() // Proceed to the requested route
  }
})

//teacherGuard
router.beforeEach((to, from, next) => {
  const user = store.getters.getUser;

  // Check if the route requires authentication
  if (to.matched.some(record => record.meta.requiresTeacher)) {
    // If the user is not authenticated, redirect to the login page
    if (!user) {
      next({
        path: '/login',
        query: { redirect: to.fullPath } // Save the current route for later redirect after login
      })
    } else {
      // If the user is authenticated, check if they are a teacher
      if (user.role === 'teacher') {
        // If the user is a teacher, allow access to the route
        next()
      } else {
        // If the user is not a teacher, deny access and redirect to the home page
        next({ path: '/' })
      }
    }
  } else {
    // If the route does not require authentication, allow access to the route
    next()
  }
})

export default router;

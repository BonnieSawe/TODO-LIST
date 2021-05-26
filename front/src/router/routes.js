import Home from "@/views/Home.vue";

import Register from "@/views/auth/Register";
import Login from "@/views/auth/Login";
import ForgotPassword from "@/views/auth/ForgotPassword";
import ResetPassword from "@/views/auth/ResetPassword";
<<<<<<< HEAD
=======
import store from '@/store'

function guardRoute(to, from, next)
{
  var isAuthenticated = store.getters["auth/check"];

  if(isAuthenticated) 
  {
    next(); 
  } 
  else
  {
    next('/login');
  }
}

>>>>>>> develop

export const routes = [
      {
        path: "/",
        name: "home",
<<<<<<< HEAD
=======
        beforeEnter : guardRoute,
>>>>>>> develop
        component: Home,
      },

      {
        path: "/login",
        name: "login",
        component: Login,
      },

      {
        path: "/register",
        name: "register",
        component: Register,
      },
      {
        path: "/forgot-password",
        name: "forgot-password",
        component: ForgotPassword,
      },
      {
        path: "/reset-password/:token",
        name: "reset-password/:token",
        props: true,
        component: ResetPassword,
      },

  ];

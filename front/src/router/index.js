import Vue from "vue";
import VueRouter from "vue-router";
import { routes } from "./routes";
import store from '@/store'

Vue.use(VueRouter);

const router = createRouter();

export default router;


function createRouter() {
  const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
  });

  router.beforeEach(beforeEach);
  router.afterEach(afterEach);

  return router;
}



async function beforeEach(to, from, next) {
  let isAuthenticated = store.getters["auth/check"];

  next();
}

async function afterEach(to, from, next) {}

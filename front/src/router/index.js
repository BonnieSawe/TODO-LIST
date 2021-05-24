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

  return router;
}

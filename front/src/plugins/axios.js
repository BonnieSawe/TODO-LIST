import Vue from "vue";
import axios from "axios";
import store from "@/store";

const $axios = axios.create({
  baseURL: process.env.VUE_APP_API_BASE_URL,
  headers: {
    "X-Requested-With": "XMLHttpRequest",
  },
});

$axios.interceptors.request.use((request) => {
  const token = store.getters["auth/token"];
  if (token) {
    request.headers.common["Authorization"] = `Bearer ${token}`;
  }
  return request;
});

Vue.prototype.$axios = $axios;

export default $axios;

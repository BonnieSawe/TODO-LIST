import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'

import './components'
import "./plugins/axios";
import './assets/scss/app.scss'

Vue.config.productionTip = false

import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import vuetify from './plugins/vuetify';

[BootstrapVue, IconsPlugin].forEach((plugin) => Vue.use(plugin));

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')

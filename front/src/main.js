import Vue from 'vue'
import App from './App.vue'
<<<<<<< HEAD
import './registerServiceWorker'
=======
>>>>>>> develop
import router from './router'
import store from './store'

import './components'
import "./plugins/axios";
import './assets/scss/app.scss'

Vue.config.productionTip = false

import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import vuetify from './plugins/vuetify';

<<<<<<< HEAD
=======
// Vue component registration
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

>>>>>>> develop
[BootstrapVue, IconsPlugin].forEach((plugin) => Vue.use(plugin));

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')

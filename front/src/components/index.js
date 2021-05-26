import Vue from "vue";

import Dash from "./wrappers/Dash";
import Auth from "./wrappers/Auth";

const components = [
    Dash,
    Auth,
];

components.forEach((element) => {
  Vue.component(element.name, element);
});

import { createApp } from "vue";

import App from "./App.vue";
import router from "./router";
import store from "./store";

import methods from "./methods/methods.js";

import axios from "axios";

const app = createApp(App);

app.config.globalProperties.$axios = axios;
app.config.globalProperties.$cookies = {};

app.use(store).use(router).use(methods).mount("#app");

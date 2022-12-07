import { createApp } from "vue";

import App from "./App.vue";
import router from "./router";
import store from "./store";

import axios from "axios";

const app = createApp(App);

app.config.globalProperties.$axios = axios;
app.config.globalProperties.$cookies = {};
app.config.globalProperties.$modalOpened = false;

app.use(store).use(router).mount("#app");

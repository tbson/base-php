import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import "style/main.css";
import Home from "component/home/index.vue";
import Login from "component/auth/login/index.vue";
import App from "src/App.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/login", component: Login }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

const app = createApp(App);

app.use(router);

app.component("Home", Home);
app.component("Login", Login);

app.mount("#app");

import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import "element-plus/dist/index.css";
import "style/main.css";
import Home from "component/home/index.vue";
import Login from "component/auth/login/login_page.vue";
import NotFound from "component/common/not_found.vue";
import BlankLayout from "component/common/layout/blank_layout.vue";
import MainLayout from "component/common/layout/main_layout.vue";
import App from "src/App.vue";

const routes = [
    {
        path: "/",
        component: MainLayout,
        children: [
            { path: "/", component: Home },
            { path: "/login", component: Login }
        ]
    },
    { path: "/:pathMatch(.*)*", component: NotFound }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

const app = createApp(App);
app.use(router);
app.mount("#app");

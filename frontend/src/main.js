import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import "element-plus/dist/index.css";
import "style/main.css";
import HomePage from "component/home/home_page.vue";
import LoginPage from "component/auth/login/login_page.vue";
import ProfilePage from "component/account/profile/profile_page.vue";
import NotFound from "component/common/not_found.vue";
import BlankLayout from "component/common/layout/blank_layout.vue";
import MainLayout from "component/common/layout/main_layout.vue";
import PrivateRoute from "component/common/route/private_route.vue";
import App from "src/App.vue";

const routes = [
    {
        path: "/",
        component: BlankLayout,
        children: [
            { path: "", component: HomePage },
            { path: "login", component: LoginPage }
        ]
    },
    {
        path: "/app",
        component: PrivateRoute,
        children: [
            {
                path: "",
                component: MainLayout,
                children: [{ path: "profile", component: ProfilePage }]
            }
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

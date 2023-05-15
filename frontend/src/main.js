import { createApp } from "vue";
import { createPinia } from "pinia";
import { createRouter, createWebHistory } from "vue-router";
import "element-plus/dist/index.css";
import "style/main.css";
import App from "src/App.vue";
import NotFound from "component/common/not_found.vue";
import BlankLayout from "component/common/layout/blank_layout.vue";
import MainLayout from "component/common/layout/main_layout.vue";
import PrivateRoute from "component/common/route/private_route.vue";

import HomePage from "component/home/home_page.vue";
import LoginPage from "component/auth/login/login_page.vue";
import ProfilePage from "component/account/profile/profile_page.vue";
import VariablePage from "component/config/variable/variable_page.vue";
import GroupPage from "component/role/group/group_page.vue";

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
            },
            {
                path: "config",
                component: MainLayout,
                children: [{ path: "variable", component: VariablePage }]
            },
            {
                path: "role",
                component: MainLayout,
                children: [{ path: "group", component: GroupPage }]
            }
        ]
    },
    { path: "/:pathMatch(.*)*", component: NotFound }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});
const pinia = createPinia();
const app = createApp(App);
app.use(pinia);
app.use(router);
app.mount("#app");

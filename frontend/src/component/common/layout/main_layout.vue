<template>
    <el-container class="layout-container-demo" style="height: 100vh">
        <el-aside width="250px">
            <el-scrollbar>
                <el-menu :default-openeds="['1', '2', '3']">
                    <el-menu-item index="1">Profile</el-menu-item>
                    <el-menu-item index="2">Variable</el-menu-item>
                    <el-sub-menu index="3">
                        <template #title>
                            <el-icon><message /></el-icon>Navigator One
                        </template>
                        <el-menu-item index="3-1">Option 1</el-menu-item>
                        <el-menu-item index="3-2">Option 2</el-menu-item>
                    </el-sub-menu>
                </el-menu>
            </el-scrollbar>
        </el-aside>

        <el-container>
            <el-header style="text-align: right; font-size: 12px">
                <div class="toolbar">
                    <el-dropdown>
                        <el-icon style="margin-right: 8px; margin-top: 1px"
                            ><setting
                        /></el-icon>
                        <template #dropdown>
                            <el-dropdown-menu>
                                <el-dropdown-item>Profile</el-dropdown-item>
                                <el-dropdown-item>Logout</el-dropdown-item>
                            </el-dropdown-menu>
                        </template>
                    </el-dropdown>
                    <span>Tom</span>
                </div>
            </el-header>

            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import { Menu as IconMenu, Message, Setting } from "@element-plus/icons-vue";

const item = {
    date: "2016-05-02",
    name: "Tom",
    address: "No. 189, Grove St, Los Angeles"
};
const tableData = ref(Array.from({ length: 20 }).fill(item));
</script>

<style scoped>
.layout-container-demo .el-header {
    position: relative;
    background-color: var(--el-color-primary-light-7);
    color: var(--el-text-color-primary);
}
.layout-container-demo .el-aside {
    color: var(--el-text-color-primary);
    background: white;
}

.layout-container-demo .el-aside {
    border-right: 1px solid #ebeef5;
}

.layout-container-demo .el-menu {
    border-right: none;
}
.layout-container-demo .el-main {
    padding: 0;
}
.layout-container-demo .toolbar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    right: 20px;
}
</style>

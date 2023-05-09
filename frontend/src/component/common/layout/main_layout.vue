<template>
    <el-container class="layout-container" style="height: 100vh">
        <el-aside :class="{ 'sidebar-mobile': isCollapse, sidebar: !isCollapse }">
            <div class="flex-container">
                <div class="logo" v-if="!isCollapse">LOGO</div>
                <div class="logo" v-if="isCollapse">O</div>
            </div>
            <el-scrollbar>
                <el-menu :default-openeds="['1', '2', '3']" :collapse="isCollapse">
                    <el-menu-item index="1">
                        <el-icon><setting /></el-icon>
                        <template #title>Profile</template>
                    </el-menu-item>
                    <el-menu-item index="2">
                        <el-icon><setting /></el-icon>
                        <template #title>Variable</template>
                    </el-menu-item>
                    <el-sub-menu index="3">
                        <template #title>
                            <el-icon><message /></el-icon>
                            <span>Navigator One</span>
                        </template>
                        <el-menu-item index="3-1">
                            <el-icon><setting /></el-icon>
                            <template #title>Option 1</template>
                        </el-menu-item>
                        <el-menu-item index="3-2">
                            <el-icon><setting /></el-icon>
                            <template #title>Option 2</template>
                        </el-menu-item>
                    </el-sub-menu>
                </el-menu>
            </el-scrollbar>
        </el-aside>

        <el-container>
            <el-header class="header" style="font-size: 12px">
                <el-row>
                    <el-col :span="12" style="text-align: left">
                        <div class="flex-container">
                            <div>
                                <el-icon
                                    :size="30"
                                    class="pointer"
                                    @click="isCollapse = !isCollapse"
                                    ><IconMenu
                                /></el-icon>
                            </div>
                        </div>
                    </el-col>
                    <el-col :span="12" style="text-align: right">
                        <div class="toolbar">
                            <span style="margin-right: 8px">Tom</span>
                            <el-dropdown>
                                <el-icon style="margin-top: 1px"><setting /></el-icon>
                                <template #dropdown>
                                    <el-dropdown-menu>
                                        <el-dropdown-item>Profile</el-dropdown-item>
                                        <el-dropdown-item>Logout</el-dropdown-item>
                                    </el-dropdown-menu>
                                </template>
                            </el-dropdown>
                        </div>
                    </el-col>
                </el-row>
            </el-header>

            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Menu as IconMenu, Message, Setting } from "@element-plus/icons-vue";

const isCollapse = ref(false);

const screen = ref({
    width: window.innerWidth
});

const updateScreenSize = () => {
    screen.value.width = window.innerWidth;
    isCollapse.value = screen.value.width < 768;
};

onMounted(() => {
    updateScreenSize();
    window.addEventListener("resize", updateScreenSize);
});

onUnmounted(() => {
    window.removeEventListener("resize", updateScreenSize);
});
</script>

<style scoped>
.layout-container .flex-container {
    height: 56px;
    background-color: var(--el-color-primary-light-7);
    display: flex;
    align-items: center;
}

.layout-container .logo {
    font-weight: bold;
    padding-left: 20px;
    font-size: 30px;
}

.layout-container .sidebar {
    width: 250px;
    min-height: 400px;
}

.layout-container .sidebar-mobile {
    width: 64px;
    min-height: 400px;
}

.layout-container .el-header {
    padding: 0 12px;
    position: relative;
    background-color: var(--el-color-primary-light-7);
    color: var(--el-text-color-primary);
}
.layout-container .el-aside {
    color: var(--el-text-color-primary);
    background: white;
}

.layout-container .el-aside {
    border-right: 1px solid #ebeef5;
}

.layout-container .el-menu {
    border-right: none;
}
.layout-container .el-main {
    padding: 0;
}
.layout-container .toolbar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    right: 20px;
}
.layout-container .header {
    text-align: right;
    height: 56px;
}
</style>

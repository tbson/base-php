<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";

import StorageUtil from "util/storage_util";
import NavUtil from "util/nav_util";

const router = useRouter();

onMounted(() => {
    const authUser = StorageUtil.getAuthUser();
    if (!authUser) {
        NavUtil.navigateTo(router)("/login");
    }
});
</script>

<template>
    <div>
        <router-view></router-view>
    </div>
</template>

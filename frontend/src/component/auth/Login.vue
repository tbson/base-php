<script setup>
import LoginForm from "component/auth/form/LoginForm.vue";
</script>

<template>
    <el-card class="box-card">
        <template #header>
            <div class="card-header">
                <span>Login</span>
            </div>
        </template>
        <template #default>
            <LoginForm />
        </template>
    </el-card>
</template>

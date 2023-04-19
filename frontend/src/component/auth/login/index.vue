<script setup>
import { ref } from "vue";
import LoginForm from "component/auth/login/LoginForm.vue";
import { Unlock } from "@element-plus/icons-vue";

const loginForm = ref();

function submitForm() {
    loginForm.value.submitForm();
}
</script>

<template>
    <el-row>
        <el-col :offset="6" :span="12">
            <el-card class="box-card">
                <template #header>
                    <div class="card-header">
                        <span>Please login</span>
                    </div>
                </template>
                <template #default>
                    <LoginForm id="login-form" ref="loginForm" />
                    <el-row>
                        <el-col :span="12">
                            <el-button type="primary" link> Forgot password </el-button>
                        </el-col>
                        <el-col :span="12" class="right">
                            <el-button
                                type="primary"
                                native-type="submit"
                                :icon="Unlock"
                                @click="submitForm"
                            >
                                Login
                            </el-button>
                        </el-col>
                    </el-row>
                </template>
            </el-card>
        </el-col>
    </el-row>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { Unlock } from "@element-plus/icons-vue";
import LoginForm from "component/auth/login/login_form.vue";
import ResetPwdDialog from "component/auth/reset_pwd/reset_pwd_dialog.vue";
import StorageUtil from "util/storage_util";
import NavUtil from "util/nav_util";

const router = useRouter();
const loginForm = ref();
const resetPwdDialog = ref();

onMounted(() => {
    const authUser = StorageUtil.getAuthUser();
    if (authUser) {
        NavUtil.navigateTo(router)("/app/profile");
    }
});

function triggerSubmit() {
    loginForm.value.handleSubmit();
}

function openResetPwdDialog() {
    resetPwdDialog.value.toggle(true);
}

function handleSubmit(data) {
    StorageUtil.setAuthData(data);
    NavUtil.navigateTo(router)("/app/profile");
}
</script>

<template>
    <el-row style="margin-top: 20px">
        <el-col :offset="6" :span="12">
            <el-card class="box-card">
                <template #header>
                    <div class="card-header">
                        <span>Please login</span>
                    </div>
                </template>
                <template #default>
                    <LoginForm
                        id="login-form"
                        ref="loginForm"
                        :on-change="handleSubmit"
                    />
                    <el-row>
                        <el-col :span="12">
                            <el-button
                                type="primary"
                                link
                                @click="openResetPwdDialog()"
                            >
                                Forgot password
                            </el-button>
                        </el-col>
                        <el-col :span="12" class="right-align">
                            <el-button
                                type="primary"
                                native-type="submit"
                                :icon="Unlock"
                                @click="triggerSubmit"
                            >
                                Login
                            </el-button>
                        </el-col>
                    </el-row>
                </template>
            </el-card>
        </el-col>
    </el-row>
    <ResetPwdDialog ref="resetPwdDialog" />
</template>

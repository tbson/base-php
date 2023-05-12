<script setup>
import { ref, onMounted } from "vue";
import EventUtil from "util/event_util";
import RequestUtil from "util/request_util";
import ProfileDialog from "component/account/profile/profile_dialog.vue";
import { urls } from "component/account/config";

const profileData = ref({});
const profileDialog = ref();

onMounted(() => {
    getProfile();
});

function getProfile() {
    EventUtil.toggleGlobalLoading();
    RequestUtil.apiCall(urls.profile)
        .then((data) => {
            profileData.value = data;
        })
        .finally(() => {
            EventUtil.toggleGlobalLoading(false);
        });
}

function openProfileDialog() {
    profileDialog.value.toggle(true);
}

function handleChange() {
    getProfile();
}
</script>

<template>
    <div class="content">
        <el-descriptions
            class="margin-top"
            title="Profile information"
            :column="1"
            direction="horizontal"
            border
        >
            <el-descriptions-item>
                <template #label>
                    <div class="cell-item">Name</div>
                </template>
                <div v-text="profileData.name"></div>
            </el-descriptions-item>
            <el-descriptions-item>
                <template #label>
                    <div class="cell-item">Email</div>
                </template>
                <div v-text="profileData.email"></div>
            </el-descriptions-item>
            <el-descriptions-item>
                <template #label>
                    <div class="cell-item">Mobile</div>
                </template>
                <div v-text="profileData.mobile"></div>
            </el-descriptions-item>
        </el-descriptions>
        <div class="right-align" style="margin-top: 5px">
            <el-button type="warning">Change password</el-button>
            <el-button type="primary" @click="openProfileDialog"
                >Update profile</el-button
            >
        </div>
    </div>
    <ProfileDialog ref="profileDialog" :on-change="handleChange" />
</template>

<script setup>
import { ref, onMounted, onUnmounted, defineProps } from "vue";
import EventUtil from "util/event_util.js";
import RequestUtil from "util/request_util";
import FormUtil from "util/form_util.js";
import ProfileForm from "component/account/profile/profile_form.vue";
import { urls } from "component/account/config.js";

const props = defineProps({
    onChange: Function
});

const open = ref(false);
const form = ref();
const profileData = ref({});

const toggleEvent = "TOGGLE_UPDATE_PROFILE_DIALOG";

function getProfile() {
    EventUtil.toggleGlobalLoading();
    return RequestUtil.apiCall(urls.profile)
        .then((data) => {
            return data;
        })
        .catch((err) => {
            FormUtil.setPopupErrors(err);
        })
        .finally(() => {
            EventUtil.toggleGlobalLoading(false);
        });
}

function toggle(open = true) {
    EventUtil.event.dispatch(toggleEvent, { open });
}

function handleToggle({ detail }) {
    if (!detail.open) {
        open.value = false;
        return;
    }
    getProfile().then((data) => {
        open.value = true;
        profileData.value = data;
    });
}

function triggerSubmit() {
    form.value.triggerSubmit();
}

function handleChange(data) {
    open.value = false;
    props.onChange();
}

onMounted(() => {
    EventUtil.event.listen(toggleEvent, handleToggle);
});

onUnmounted(() => {
    EventUtil.event.remove(toggleEvent, handleToggle);
});

defineExpose({
    toggle
});
</script>

<template>
    <el-dialog destroy-on-close v-model="open" title="Update profile" width="60%">
        <ProfileForm ref="form" :data="profileData" :on-change="handleChange" />
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="open = false">Cancel</el-button>
                <el-button type="primary" @click="triggerSubmit">
                    Update profile
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>

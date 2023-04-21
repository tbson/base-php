<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import EventUtil from "util/event_util.js";
import ResetPwdForm from "component/auth/reset_pwd/reset_pwd_form.vue";

const open = ref(false);
const form = ref();

const toggleEvent = "TOGGLE_RESET_PASSWORD_DIALOG";

function toggle(open = true) {
    EventUtil.event.dispatch(toggleEvent, { open });
}

function handleToggle({ detail }) {
    open.value = detail.open;
}

function handleSubmit() {
    form.value.handleSubmit();
    // open.value = false;
}

onMounted(() => {
    console.log("Mounted");
    EventUtil.event.listen(toggleEvent, handleToggle);
});

onUnmounted(() => {
    console.log("Unmounted");
    EventUtil.event.remove(toggleEvent, handleToggle);
});

defineExpose({
    toggle
});
</script>

<template>
    <el-dialog destroy-on-close v-model="open" title="Reset password" width="60%">
        <ResetPwdForm ref="form" />
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="open = false">Cancel</el-button>
                <el-button type="primary" @click="handleSubmit">
                    Reset password
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>

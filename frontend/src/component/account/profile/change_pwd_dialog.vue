<script setup>
import { ref, onMounted, onUnmounted, defineProps } from "vue";
import EventUtil from "util/event_util.js";
import RequestUtil from "util/request_util";
import FormUtil from "util/form_util.js";
import ChangePwdForm from "component/account/profile/change_pwd_form.vue";
import { urls } from "component/account/config.js";

const props = defineProps({
    onChange: Function
});

const open = ref(false);
const form = ref();

const toggleEvent = "TOGGLE_CHANGE_PWD_DIALOG";

function toggle(open = true) {
    EventUtil.event.dispatch(toggleEvent, { open });
}

function handleToggle({ detail }) {
    if (!detail.open) {
        open.value = false;
        return;
    }
    open.value = true;
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
    <el-dialog destroy-on-close v-model="open" title="Change password" width="60%">
        <ChangePwdForm ref="form" :on-change="handleChange" />
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="open = false">Cancel</el-button>
                <el-button type="primary" @click="triggerSubmit">
                    Change password
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>

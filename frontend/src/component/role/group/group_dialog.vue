<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import EventUtil from "util/event_util.js";
import RequestUtil from "util/request_util";
import FormUtil from "util/form_util.js";
import Form from "component/role/group/group_form.vue";
import { urls } from "component/role/group/config.js";

const props = defineProps({
    onChange: Function
});

const id = ref(null);
const open = ref(false);
const form = ref();
const data = ref({});

const toggleEvent = "TOGGLE_GROUP_DIALOG";

function getItem(id) {
    EventUtil.toggleGlobalLoading();
    const url = `${urls.crud}${id}`;
    return RequestUtil.apiCall(url)
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

function toggle(open = true, id = null) {
    EventUtil.event.dispatch(toggleEvent, { open, id });
}

function handleToggle({ detail }) {
    id.value = detail.id;
    if (!detail.open) {
        open.value = false;
        return;
    }
    if (detail.id) {
        getItem(detail.id).then((item) => {
            open.value = true;
            data.value = item;
        });
    } else {
        open.value = true;
        data.value = {};
    }
}

function triggerSubmit() {
    form.value.triggerSubmit();
}

function handleChange(data) {
    open.value = false;
    props.onChange(id.value, data);
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
    <el-dialog destroy-on-close v-model="open" title="Group" width="60%">
        <Form ref="form" :id="id" :data="data" :on-change="handleChange" />
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="open = false">Cancel</el-button>
                <el-button type="primary" @click="triggerSubmit"> Submit </el-button>
            </span>
        </template>
    </el-dialog>
</template>

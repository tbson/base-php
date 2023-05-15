<script setup>
import { reactive, ref, toRaw, onMounted } from "vue";
import { profileTypeOptionStore } from "store/profile_type_option";
import FormUtil from "util/form_util.js";
import EventUtil from "util/event_util.js";
import { urls } from "component/role/group/config.js";

const store = profileTypeOptionStore();

const props = defineProps({
    id: Number,
    data: Object,
    onChange: Function
});

const formRef = ref();
const focusRef = ref();

// do not use same name with ref
const form = reactive({
    title: props.data.title,
    profile_type: props.data.profile_type,
    default: props.data.default
});

const rules = reactive({
    title: [
        {
            required: true,
            message: "Please input title",
            trigger: ["blur", "change"]
        }
    ],
    profile_type: [
        {
            required: true,
            message: "Please input profile type",
            trigger: ["blur", "change"]
        }
    ],
    default: [
        {
            type: "boolean"
        }
    ]
});

onMounted(() => {
    setTimeout(() => focusRef.value.focus(), 100);
});

function triggerSubmit() {
    const formRefInstance = formRef.value;
    formRefInstance.validate((valid, fields) => {
        if (valid) {
            const payload = toRaw(form);
            const url = props.id ? `${urls.crud}${props.id}` : urls.crud;
            const method = props.id ? "put" : "post";
            FormUtil.submit(url, payload, method)
                .then(props.onChange)
                .catch(FormUtil.setFormErrors(form));
        } else {
            console.log("error submit!", fields);
        }
    });
}
defineExpose({
    triggerSubmit
});
</script>

<template>
    <el-form
        ref="formRef"
        :model="form"
        :rules="rules"
        label-width="120px"
        @submit.prevent="triggerSubmit"
    >
        <el-form-item label="Title" prop="title">
            <el-input ref="focusRef" v-model="form.title" placeholder="Title..." />
        </el-form-item>
        <el-form-item label="Type" prop="type">
            <el-select
                v-model="form.profile_type"
                filterable
                placeholder="Profile type"
                class="full-width"
            >
                <el-option
                    v-for="item in store.value"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                />
            </el-select>
        </el-form-item>
        <el-form-item label="Default" prop="default">
            <el-switch v-model="form.default" />
        </el-form-item>

        <button type="submit" class="hidden"></button>
    </el-form>
</template>

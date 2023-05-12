<script setup>
import { reactive, ref, defineProps, toRaw } from "vue";
import FormUtil from "util/form_util.js";
import EventUtil from "util/event_util.js";
import { urls } from "component/account/config.js";

const props = defineProps({
    data: Object,
    onChange: Function
});

const formRef = ref();

// do not use same name with ref
const form = reactive({
    name: props.data.name,
    email: props.data.email,
    mobile: props.data.mobile
});
/*
const errors = reactive({
    username: "hello",
    password: ""
});
*/

const rules = reactive({
    name: [
        {
            required: true,
            message: "Please input your name",
            trigger: ["blur", "change"]
        }
    ],
    email: [
        {
            required: true,
            message: "Please input your email",
            trigger: ["blur", "change"]
        }
    ],
    mobile: [
        {
            required: true,
            message: "Please input your phone number",
            trigger: ["blur", "change"]
        }
    ]
});

function triggerSubmit() {
    const formRefInstance = formRef.value;
    formRefInstance.validate((valid, fields) => {
        if (valid) {
            const payload = toRaw(form);
            FormUtil.submit(urls.profile, payload, "put")
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
        <!--
        <el-form-item
            label="Email"
            prop="username"
            :validate-status="errors.username ? 'error' : ''"
            :error="errors.username || ''"
        >
            <el-input v-model="form.username" type="username" placeholder="Email..." />
        </el-form-item>
        -->
        <el-form-item label="Name" prop="name">
            <el-input v-model="form.name" placeholder="Name..." />
        </el-form-item>
        <el-form-item label="Email" prop="email">
            <el-input v-model="form.email" type="email" placeholder="Email..." />
        </el-form-item>
        <el-form-item label="Mobile" prop="mobile">
            <el-input v-model="form.mobile" placeholder="Mobile..." />
        </el-form-item>

        <button type="submit" class="hidden"></button>
    </el-form>
</template>

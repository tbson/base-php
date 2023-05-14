<script setup>
import { reactive, ref, toRaw } from "vue";
import FormUtil from "util/form_util.js";
import EventUtil from "util/event_util.js";
import { urls } from "component/auth/config.js";

const props = defineProps({
    onChange: Function
});

const formRef = ref();

// do not use same name with ref
const form = reactive({
    username: "admin@localhost.dev",
    password: "Qwerty!@#456"
});
/*
const errors = reactive({
    username: "hello",
    password: ""
});
*/

const rules = reactive({
    username: [
        { required: true, message: "Please input your username", trigger: "blur" },
        {
            message: "Please input username",
            trigger: ["blur", "change"]
        }
    ],
    password: [
        { required: true, message: "Please input your password", trigger: "blur" },
        {
            message: "Please input password",
            trigger: ["blur", "change"]
        }
    ]
});

function triggerSubmit() {
    const formRefInstance = formRef.value;
    formRefInstance.validate((valid, fields) => {
        if (valid) {
            const payload = toRaw(form);
            FormUtil.submit(urls.login, payload)
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
        <el-form-item label="Username" prop="username">
            <el-input v-model="form.username" type="username" placeholder="Email..." />
        </el-form-item>
        <el-form-item label="Password" prop="password">
            <el-input
                v-model="form.password"
                type="password"
                placeholder="Password..."
            />
        </el-form-item>
        <button type="submit" class="hidden"></button>
    </el-form>
</template>

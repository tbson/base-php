<script setup>
import { reactive, ref, toRaw } from "vue";
import FormUtil from "util/form_util.js";
import EventUtil from "util/event_util.js";
import { basicAuthUrls } from "component/account/config.js";

const props = defineProps({
    onChange: Function
});

const formRef = ref();

// do not use same name with ref
const form = reactive({
    password: "",
    new_password: "",
    new_password_confirm: ""
});
/*
const errors = reactive({
    username: "hello",
    password: ""
});
*/

const rules = reactive({
    password: [
        {
            required: true,
            message: "Please input current password",
            trigger: ["blur", "change"]
        }
    ],
    new_password: [
        {
            required: true,
            message: "Please input new password",
            trigger: ["blur", "change"]
        }
    ],
    new_password_confirm: [
        {
            required: true,
            message: "Please confirm new password",
            trigger: ["blur", "change"]
        }
    ]
});

function triggerSubmit() {
    const formRefInstance = formRef.value;
    formRefInstance.validate((valid, fields) => {
        if (valid) {
            const payload = toRaw(form);
            FormUtil.submit(basicAuthUrls.changePwd, payload, "post")
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
        label-width="170px"
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

        <el-form-item label="Password" prop="password">
            <el-input
                v-model="form.password"
                type="password"
                placeholder="Current password..."
            />
        </el-form-item>
        <el-form-item label="New password" prop="new_password">
            <el-input
                v-model="form.new_password"
                type="password"
                placeholder="New password..."
            />
        </el-form-item>
        <el-form-item label="Confirm new password" prop="new_password_confirm">
            <el-input
                v-model="form.new_password_confirm"
                type="password"
                placeholder="Confirm new password..."
            />
        </el-form-item>

        <button type="submit" class="hidden"></button>
    </el-form>
</template>

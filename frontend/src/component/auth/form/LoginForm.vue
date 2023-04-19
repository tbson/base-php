<script setup>
import { reactive, ref } from "vue";

const formRef = ref();

// do not use same name with ref
const form = reactive({
    email: "",
    password: ""
});

const rules = reactive({
    email: [
        { required: true, message: "Please input your email", trigger: "blur" },
        {
            type: "email",
            message: "Please input correct email address",
            trigger: ["blur", "change"]
        }
    ],
    password: [
        { required: true, message: "Please input your password", trigger: "blur" },
        {
            min: 6,
            message: "Password must be at least 6 characters",
            trigger: ["blur", "change"]
        }
    ]
});

const submitForm = async (formEl) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            console.log("submit!");
        } else {
            console.log("error submit!", fields);
        }
    });
};
</script>

<template>
    <el-form
        ref="formRef"
        :model="form"
        :rules="rules"
        label-width="120px"
        @submit.prevent="submitForm(formRef)"
    >
        <el-form-item label="Email" prop="email">
            <el-input v-model="form.email" type="email" placeholder="Email..." />
        </el-form-item>

        <el-form-item label="Password" prop="password">
            <el-input
                v-model="form.password"
                type="password"
                placeholder="Password..."
            />
        </el-form-item>

        <el-form-item>
            <el-button type="primary" native-type="submit">Create</el-button>
        </el-form-item>
    </el-form>
</template>

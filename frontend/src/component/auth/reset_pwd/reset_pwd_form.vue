<script setup>
import { reactive, ref } from "vue";

const formRef = ref();

const form = reactive({
    email: ""
});

const rules = reactive({
    email: [
        { required: true, message: "Please input your email", trigger: "blur" },
        {
            type: "email",
            message: "Please input correct email address",
            trigger: ["blur", "change"]
        }
    ]
});

function triggerSubmit() {
    const form = formRef.value;
    form.validate((valid, fields) => {
        if (valid) {
            console.log("submit!");
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
        <el-form-item label="Email" prop="email">
            <el-input v-model="form.email" type="email" placeholder="Email..." />
        </el-form-item>
        <button type="submit" class="hidden"></button>
    </el-form>
</template>

<script setup>
import { reactive, ref, toRaw, onMounted } from "vue";
import { variableTypeOptionStore } from "store/variable_type_option";
import FormUtil from "util/form_util.js";
import EventUtil from "util/event_util.js";
import { urls } from "component/config/variable/config.js";

const store = variableTypeOptionStore();

const props = defineProps({
    id: Number,
    data: Object,
    onChange: Function
});

const formRef = ref();
const focusRef = ref();

// do not use same name with ref
const form = reactive({
    uid: props.data.uid,
    value: props.data.value,
    type: props.data.type,
    description: props.data.description
});

const rules = reactive({
    uid: [
        {
            required: true,
            message: "Please input UID",
            trigger: ["blur", "change"]
        }
    ],
    value: [
        {
            required: true,
            message: "Please input value",
            trigger: ["blur", "change"]
        }
    ],
    type: [
        {
            required: true,
            message: "Please input type",
            trigger: ["blur", "change"]
        }
    ],
    description: [
        {
            required: true,
            message: "Please input description",
            trigger: ["blur", "change"]
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
        <el-form-item label="UID" prop="uid">
            <el-input ref="focusRef" v-model="form.uid" placeholder="UID..." />
        </el-form-item>
        <el-form-item label="Value" prop="value">
            <el-input v-model="form.value" placeholder="Value..." />
        </el-form-item>
        <el-form-item label="Type" prop="type">
            <el-select
                v-model="form.type"
                filterable
                placeholder="Type"
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
        <el-form-item label="Descritpion" prop="description">
            <el-input v-model="form.description" placeholder="Descritpion..." />
        </el-form-item>

        <button type="submit" class="hidden"></button>
    </el-form>
</template>

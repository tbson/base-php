<script setup>
import { ArrowLeft, ArrowRight } from "@element-plus/icons-vue";
const props = defineProps({
    next: String,
    prev: Object,
    onChange: Function
});
</script>

<template>
    <div style="display: flex; justify-content: flex-end; margin-top: 5px">
        <el-button v-if="prev" type="primary" :icon="ArrowLeft" />
        <el-button v-if="next" type="primary" :icon="ArrowRight" />
    </div>
</template>

<script setup>
import { ArrowLeft, ArrowRight } from "@element-plus/icons-vue";
const props = defineProps({
    next: String,
    prev: Object,
    onChange: Function
});

function hanldeClick(url) {
    const paramsString = url.split("?")[1];
    const searchParams = new URLSearchParams(paramsString);
    const page = parseInt(searchParams.get("page") || 1);
    props.onChange({ page });
}
</script>

<template>
    <div style="display: flex; justify-content: flex-end; margin-top: 5px">
        <el-button
            v-if="prev"
            type="primary"
            :icon="ArrowLeft"
            @click="hanldeClick(prev)"
        />
        <el-button
            v-if="next"
            type="primary"
            :icon="ArrowRight"
            @click="hanldeClick(next)"
        />
    </div>
</template>

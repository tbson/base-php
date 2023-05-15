<script setup>
import { ref } from "vue";
import { Search } from "@element-plus/icons-vue";

const searchInput = ref("");

const props = defineProps({
    onChange: Function
});

function handleChanage() {
    const q = searchInput.value;
    props.onChange({ q });
}
</script>

<template>
    <el-input v-model="searchInput" placeholder="Search..." @change="handleChanage">
        <template #append>
            <el-button :icon="Search" @click="handleChanage" />
        </template>
    </el-input>
</template>

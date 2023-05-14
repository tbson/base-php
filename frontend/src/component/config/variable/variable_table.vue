<script setup>
import { ref, onMounted } from "vue";
import { Delete, Edit, Plus } from "@element-plus/icons-vue";
import { variableTypeOptionStore } from "store/variable_type_option";
import EventUtil from "util/event_util";
import RequestUtil from "util/request_util";
import Dialog from "component/config/variable/variable_dialog.vue";
import { urls, messages } from "component/config/variable/config.js";

const store = variableTypeOptionStore();
const dialog = ref();
const list = ref([]);
const ids = ref([]);

onMounted(() => {
    getList();
});

function getList() {
    EventUtil.toggleGlobalLoading();
    RequestUtil.apiCall(urls.crud)
        .then((data) => {
            store.setValue(data.extra.variableTypeOption);
            list.value = data.items;
        })
        .finally(() => {
            EventUtil.toggleGlobalLoading(false);
        });
}

function handleSelectionChange(selectedIds) {
    ids.value = selectedIds.map((i) => i.id);
}

function openDialog(id = null) {
    dialog.value.toggle(true, id);
}

function handleChange(id, data) {
    if (!id) {
        list.value = [data, ...list.value];
    } else {
        const index = list.value.findIndex((item) => item.id === id);
        if (index > -1) {
            list.value[index] = data;
        }
    }
}

function handleDelete(id) {
    const r = window.confirm(messages.deleteOne);
    if (!r) return;
    EventUtil.toggleGlobalLoading(true);
    RequestUtil.apiCall(`${urls.crud}${id}`, {}, "delete")
        .then(() => {
            list.value = [...list.value.filter((item) => item.id !== id)];
        })
        .finally(() => EventUtil.toggleGlobalLoading(false));
}

function hanldeBulkDelete() {
    const r = window.confirm(messages.deleteMultiple);
    if (!r) return;

    EventUtil.toggleGlobalLoading(true);
    RequestUtil.apiCall(`${urls.crud}?ids=${ids.value.join(",")}`, {}, "delete")
        .then(() => {
            list.value = [...list.value.filter((item) => !ids.value.includes(item.id))];
            ids.value = [];
        })
        .finally(() => EventUtil.toggleGlobalLoading(false));
}
</script>

<template>
    <el-table
        :data="list"
        style="width: 100%"
        @selection-change="handleSelectionChange"
    >
        <el-table-column type="selection" width="55" />
        <el-table-column label="UID" prop="uid" />
        <el-table-column label="Value" prop="value" />
        <el-table-column label="Type" prop="type_label" />
        <el-table-column align="right">
            <template #header>
                <el-button
                    size="small"
                    type="primary"
                    :icon="Plus"
                    @click="openDialog()"
                />
            </template>
            <template #default="scope">
                <el-button
                    size="small"
                    :icon="Edit"
                    @click="openDialog(scope.row.id)"
                />
                <el-button
                    size="small"
                    type="danger"
                    :icon="Delete"
                    @click="handleDelete(scope.row.id)"
                />
            </template>
        </el-table-column>
    </el-table>

    <el-row>
        <el-col :span="12">
            <el-button
                v-if="ids.length > 0"
                size="small"
                type="danger"
                :icon="Delete"
                @click="hanldeBulkDelete()"
            />
        </el-col>
        <el-col :span="12" class="right-align">Pagination</el-col>
    </el-row>
    <Dialog ref="dialog" :on-change="handleChange" />
</template>

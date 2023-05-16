<script setup>
import { ref, onMounted, watch } from "vue";
import { Delete, Edit, Plus, CircleCheck, CircleClose } from "@element-plus/icons-vue";
import { profileTypeOptionStore } from "store/profile_type_option";
import { pemTransferOptionStore } from "store/pem_transfer_option";
import EventUtil from "util/event_util";
import RequestUtil from "util/request_util";
import Pagination from "component/common/table/pagination.vue";
import SearchInput from "component/common/table/search_input.vue";
import Dialog from "component/role/group/group_dialog.vue";
import { urls, messages } from "component/role/group/config.js";

const store = {
    profileTypeOption: profileTypeOptionStore(),
    pemTransferOption: pemTransferOptionStore()
};
const dialog = ref();
const list = ref([]);
const ids = ref([]);
const links = ref({});
const pagingParam = ref({});
const searchParam = ref({});
const filterParam = ref({});
const sortParam = ref({});

onMounted(() => {
    getList();
});

watch([pagingParam, searchParam, filterParam, sortParam], () => {
    getList();
});

function getQueryParams() {
    const params = {};
    return {
        ...params.value,
        ...pagingParam.value,
        ...searchParam.value,
        ...filterParam.value,
        ...sortParam.value
    };
}

function getList() {
    const params = getQueryParams();
    EventUtil.toggleGlobalLoading();
    RequestUtil.apiCall(urls.crud, params)
        .then((data) => {
            store.profileTypeOption.setValue(data.extra.profileTypeOption);
            store.pemTransferOption.setValue(
                data.extra.pemOption.map((i) => ({ key: i.value, label: i.label }))
            );
            list.value = data.items;
            links.value = data.links;
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

function handlePaginate(params) {
    pagingParam.value = params;
}

function handleSearch(params) {
    searchParam.value = params;
}
</script>

<template>
    <SearchInput :on-change="handleSearch" />
    <el-table
        :data="list"
        style="width: 100%"
        @selection-change="handleSelectionChange"
    >
        <el-table-column type="selection" width="55" />
        <el-table-column label="Title" prop="title" />
        <el-table-column label="Profile type" prop="profile_type_label" />
        <el-table-column label="Default" prop="default">
            <template #default="scope">
                <el-icon>
                    <CircleCheck v-if="scope.row.default" class="green" />
                    <CircleClose v-if="!scope.row.default" class="red" />
                </el-icon>
            </template>
        </el-table-column>
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
        <el-col :span="12" class="right-align"
            ><Pagination
                :next="links.next"
                :prev="links.prev"
                :on-change="handlePaginate"
        /></el-col>
    </el-row>
    <Dialog ref="dialog" :on-change="handleChange" />
</template>

import { ref } from "vue";
import { defineStore } from "pinia";
export const pemTransferOptionStore = defineStore("pemTransferOption", () => {
    const value = ref([]);
    function setValue(inputValue) {
        value.value = inputValue;
    }

    return { value, setValue };
});

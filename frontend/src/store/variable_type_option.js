import { ref } from "vue";
import { defineStore } from "pinia";
export const variableTypeOptionStore = defineStore("variableTypeOption", () => {
    const value = ref([]);
    function setValue(inputValue) {
        value.value = inputValue;
    }

    return { value, setValue };
});

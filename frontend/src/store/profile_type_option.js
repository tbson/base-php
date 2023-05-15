import { ref } from "vue";
import { defineStore } from "pinia";
export const profileTypeOptionStore = defineStore("profileTypeOption", () => {
    const value = ref([]);
    function setValue(inputValue) {
        value.value = inputValue;
    }

    return { value, setValue };
});

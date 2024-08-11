import { defineStore } from "pinia";

export const commonStore = defineStore("commonStore", {
    state: () => {
        return {
            test: 'hello',
        }
    }

});
import { defineStore } from "pinia";

export const useFollowedsStore = defineStore("followeds", {
    state: () => {
        return { followeds: [] }
    },
    actions: {
        add(followed) {
            Array.isArray(followed) ? this.followeds.push(...followed) : this.followeds.push(followed)
        },
        remove(followed) {
            this.followeds.filter(value => value = followed)
        },
    }
});
import { defineStore } from "pinia";

export const useFollowedsStore = defineStore("followeds", {
    state: () => {
        return { followeds: [] }
    },
    actions: {
        add(followed) {
            Array.isArray(followed) ? this.followeds.push(...followed) : this.followeds.push(parseInt(followed))
        },
        remove(followed) {
            this.followeds = this.followeds.filter(item => item != followed)
        },
    },
    getters: {
        getFolloweds(state) {
            return state.followeds
        }
    },
});
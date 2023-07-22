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
            console.log('filter')
            this.followeds = this.followeds.filter(item => item !== parseInt(followed))
        },
    },
    getters: {
        getFolloweds(state) {
            return state.followeds
        }
    },
});
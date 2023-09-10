import { defineStore } from "pinia";

export const useUserStore = defineStore('user', {
    state: () => {
        return { user: {} }
    },
    actions: {
        add(user) {
            this.user = user
        },
    },
    getters: {
        getUser(state) {
            return state.user
        },
        getFolloweds(state) {
            return state.user.followeds.map((followed) => followed.followed_id)
        },
    }
}); 
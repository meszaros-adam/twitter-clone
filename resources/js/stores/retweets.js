import { defineStore } from "pinia";

export const useRetweetsStore = defineStore('retweets', {
    state: () => {
        return { retweets: [] }
    },
    actions: {
        add(retweet) {
            Array.isArray(retweet) ? this.retweets.push(...retweet) : this.retweets.push(parseInt(retweet))
        },
        remove(retweet) {
            this.retweets = this.retweets.filter(item => item != retweet)
        },
    },
    getters: {
        getRetweets(state) {
            return state.retweets
        }
    }
}); 
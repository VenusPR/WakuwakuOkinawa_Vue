import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => {
        return { user: { loggedIn: false, data: null } };
    },
    actions: {
        increment(value = 1) {
            this.count += value;
        },
    },
    getters: {
        doubleCount: (state) => {
            return state.count * 2;
        },
        doublePlusOne() {
            return this.doubleCount + 1
        },
    },
});

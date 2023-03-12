import { defineStore } from "pinia";
import { auth, firebaseAuth } from '../firebaseConfig';

export const userUserStore = defineStore("user", {
    state: () => {
        return { isLoggedIn: false, userCredential: null, user: null };
    },
    actions: {
        async loginByEmail({ email, password }) {
            return firebaseAuth.signInWithEmailAndPassword(auth, email, password)
                .then(res => {
                    this.userCredential = res.user
                    this.isLoggedIn = true
                    return true

                }).catch(e => {
                    if (e.code != 400) {
                        console.error(e);
                    }
                    return false
                });
        },

        async resetPassword({ email }) {
            return firebaseAuth.sendPasswordResetEmail(auth, email)
                .then(() => {
                    return true
                }).catch(e => {
                    console.error(e);
                    return false
                });
        },

        async createUserByEmail({ email, password }) {
            return firebaseAuth.createUserWithEmailAndPassword(auth, email, password)
                .then(() => {
                    return true
                }).catch(e => {
                    console.error(e);
                    return false
                });
        },

        // async register(context, { email, password, name }) {
        //     const response = await createUserWithEmailAndPassword(auth, email, password)
        //     if (response) {
        //         context.commit('setUser', response.user)
        //         // response.user.updateProfile({ displayName: name })
        //     } else {
        //         throw new Error('Unable to register user')
        //     }
        // },
    },
    getters: {
    },
});

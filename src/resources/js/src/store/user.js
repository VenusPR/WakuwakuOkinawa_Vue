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
                    this.userCredential = res.user;
                    if (res.user.emailVerified) {
                        this.isLoggedIn = true;
                    }
                    return { user: res.user, error: null };

                }).catch(e => {
                    if (e.code != 400) {
                        console.error(e);
                    }
                    return { user: null, error: e };
                });
        },

        async logout() {
            return firebaseAuth.signOut(auth)
                .then(() => {
                    this.userCredential = null;
                    this.user = null;
                    this.isLoggedIn = false;
                    return true;

                }).catch(e => {
                    console.error(e);
                    return false;
                });
        },

        async resetPassword({ email }) {
            return firebaseAuth.sendPasswordResetEmail(auth, email)
                .then(() => {
                    return true;
                }).catch(e => {
                    console.error(e);
                    return false;
                });
        },

        async createUserByEmail({ email, password }) {
            return firebaseAuth.createUserWithEmailAndPassword(auth, email, password)
                .then(res => {
                    return { user: res.user, error: null };
                }).catch(e => {
                    console.error('ng', e.code);
                    console.error(e);
                    return { user: null, error: e };
                });
        },

        async sendEmailVerification({ firebaseUser }) {
            return firebaseAuth.sendEmailVerification(firebaseUser)
                .then(() => {
                    return true;
                }).catch(e => {
                    console.error(e);
                    return false;
                });
        },

        async sendPasswordResetEmail({ email }) {
            return firebaseAuth.sendPasswordResetEmail(auth, email)
                .then(() => {
                    return true;
                }).catch(e => {
                    console.error(e);
                    return false;
                });
        }
    },
    getters: {
    },
});

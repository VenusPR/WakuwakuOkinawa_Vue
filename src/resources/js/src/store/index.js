import { createStore } from 'vuex';
import { auth } from '../firebaseConfig';
import i18n from '../i18n';

export default new createStore({
    state: {
        layout: 'app',
        is_show_sidebar: true,
        is_show_search: false,
        is_dark_mode: false,
        dark_mode: 'light',
        locale: null,
        menu_style: 'vertical',
        layout_style: 'full',
        countryList: [
            { code: 'zh', name: 'Chinese' },
            { code: 'da', name: 'Danish' },
            { code: 'en', name: 'English' },
            { code: 'fr', name: 'French' },
            { code: 'de', name: 'German' },
            { code: 'el', name: 'Greek' },
            { code: 'hu', name: 'Hungarian' },
            { code: 'it', name: 'Italian' },
            { code: 'ja', name: 'Japanese' },
            { code: 'pl', name: 'Polish' },
            { code: 'pt', name: 'Portuguese' },
            { code: 'ru', name: 'Russian' },
            { code: 'es', name: 'Spanish' },
            { code: 'sv', name: 'Swedish' },
            { code: 'tr', name: 'Turkish' },
        ],
        // -- application data --
        user: {
            loggedIn: false,
            data: null
        }
    },
    mutations: {
        setLayout(state, payload) {
            state.layout = payload;
        },
        toggleSideBar(state, value) {
            state.is_show_sidebar = value;
        },
        toggleSearch(state, value) {
            state.is_show_search = value;
        },
        toggleLocale(state, value) {
            value = value || 'en';
            i18n.global.locale = value;
            localStorage.setItem('i18n_locale', value);
            state.locale = value;
        },

        toggleDarkMode(state, value) {
            //light|dark|system
            value = value || 'light';
            localStorage.setItem('dark_mode', value);
            state.dark_mode = value;
            if (value == 'light') {
                state.is_dark_mode = false;
            } else if (value == 'dark') {
                state.is_dark_mode = true;
            } else if (value == 'system') {
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    state.is_dark_mode = true;
                } else {
                    state.is_dark_mode = false;
                }
            }

            if (state.is_dark_mode) {
                document.querySelector('body').classList.add('dark');
            } else {
                document.querySelector('body').classList.remove('dark');
            }
        },

        toggleMenuStyle(state, value) {
            //horizontal|vertical|collapsible-vertical
            value = value || '';
            localStorage.setItem('menu_style', value);
            state.menu_style = value;
            if (!value || value === 'vertical') {
                state.is_show_sidebar = true;
            } else if (value === 'collapsible-vertical') {
                state.is_show_sidebar = false;
            }
        },

        toggleLayoutStyle(state, value) {
            //boxed-layout|large-boxed-layout|full
            value = value || '';
            localStorage.setItem('layout_style', value);
            state.layout_style = value;
        },

        setLoggedIn(state, value) {
            state.user.loggedIn = value;
        },

        setUser(state, data) {
            state.user.data = data;
        }
    },
    getters: {
        layout(state) {
            return state.layout;
        },

        user(state) {
            return state.user;
        }
    },
    actions: {
        async register(context, { email, password, name }) {
            const response = await createUserWithEmailAndPassword(auth, email, password)
            if (response) {
                context.commit('setUser', response.user)
                // response.user.updateProfile({ displayName: name })
            } else {
                throw new Error('Unable to register user')
            }
        },

        async login(context, { email, password }) {
            console.log('login 1');
            const response = await signInWithEmailAndPassword(auth, email, password)
            console.log('login 2');
            if (response) {
                context.commit('setUser', response.user)
            } else {
                throw new Error('login failed')
            }
        },

        async fetchUser(context, user) {
            context.commit("setLoggedIn", user !== null);
            if (user) {
                context.commit("setUser", {
                    displayName: user.displayName,
                    email: user.email
                });
            } else {
                context.commit("setUser", null);
            }
        }
    },
    modules: {},
});


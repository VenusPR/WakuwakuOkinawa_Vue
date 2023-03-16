module.exports = {
    extends: [
        "plugin:vue/vue3-essential",
    ],
    rules: {
        'vue/multi-word-component-names': 'off',
        "semi": ["error", "always"],
    },
    parserOptions: {
        "ecmaVersion": 13
    },
};

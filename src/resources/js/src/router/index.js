import { createRouter, createWebHistory } from 'vue-router';

import store from '../store';
import SampleHome from '../views/sample/index.vue';

import Home from '../views/index.vue';

// Vue.use(VueRouter);
// import { createApp } from 'vue';
// const app = createApp();
// app.use(createRouter);

const routes = [
    { path: '/', name: 'Home', component: Home },
    { path: '/login', name: 'Login', component: () => import('../views/login.vue'), },
    { path: '/profile', name: 'Profile', component: () => import('../views/profile/index.vue'), },
    { path: '/profile/bank', name: 'Bank', component: () => import('../views/profile/bank.vue'), },

    // ------- 以下は sample --------------------------------

    //dashboard
    { path: '/sample', name: 'Sample Home', component: SampleHome },

    {
        path: '/sample/index2',
        name: 'index2',
        component: () => import(/* webpackChunkName: "index2" */ '../views/sample/index2.vue'),
    },

    //components
    {
        path: '/sample/components/tabs',
        name: 'tabs',
        component: () => import(/* webpackChunkName: "components-tabs" */ '../views/sample/components/tabs.vue'),
    },
    {
        path: '/sample/components/accordions',
        name: 'accordions',
        component: () => import(/* webpackChunkName: "components-accordions" */ '../views/sample/components/accordions.vue'),
    },
    {
        path: '/sample/components/modals',
        name: 'modals',
        component: () => import(/* webpackChunkName: "components-modals" */ '../views/sample/components/modals.vue'),
    },
    {
        path: '/sample/components/cards',
        name: 'cards',
        component: () => import(/* webpackChunkName: "components-cards" */ '../views/sample/components/cards.vue'),
    },
    {
        path: '/sample/components/carousel',
        name: 'carousel',
        component: () => import(/* webpackChunkName: "components-carousel" */ '../views/sample/components/carousel.vue'),
    },

    {
        path: '/sample/components/timeline',
        name: 'timeline',
        component: () => import(/* webpackChunkName: "components-timeline" */ '../views/sample/components/timeline.vue'),
    },
    {
        path: '/sample/components/media-object',
        name: 'media-object',
        component: () => import(/* webpackChunkName: "components-media-object" */ '../views/sample/components/media_object.vue'),
    },
    {
        path: '/sample/components/list-group',
        name: 'list-group',
        component: () => import(/* webpackChunkName: "components-list-group" */ '../views/sample/components/list_group.vue'),
    },
    {
        path: '/sample/components/pricing-table',
        name: 'pricing-table',
        component: () => import(/* webpackChunkName: "components-pricing-table" */ '../views/sample/components/pricing_table.vue'),
    },
    {
        path: '/sample/components/notifications',
        name: 'notifications',
        component: () => import(/* webpackChunkName: "components-notifications" */ '../views/sample/components/toast.vue'),
    },

    {
        path: '/sample/components/lightbox',
        name: 'lightbox',
        component: () => import(/* webpackChunkName: "components-lightbox" */ '../views/sample/components/lightbox.vue'),
    },
    {
        path: '/sample/components/countdown',
        name: 'countdown',
        component: () => import(/* webpackChunkName: "components-countdown" */ '../views/sample/components/countdown.vue'),
    },
    {
        path: '/sample/components/counter',
        name: 'counter',
        component: () => import(/* webpackChunkName: "components-counter" */ '../views/sample/components/counter.vue'),
    },
    {
        path: '/sample/components/sweetalert',
        name: 'sweetalert',
        component: () => import(/* webpackChunkName: "components-sweetalert" */ '../views/sample/components/sweetalert.vue'),
    },

    //fonts
    {
        path: '/sample/font-icons',
        name: 'font-icons',
        component: () => import(/* webpackChunkName: "font-icons" */ '../views/sample/font_icons.vue'),
    },

    //pages
    {
        path: '/sample/pages/helpdesk',
        name: 'helpdesk',
        component: () => import(/* webpackChunkName: "pages-helpdesk" */ '../views/sample/pages/helpdesk.vue'),
    },
    {
        path: '/sample/pages/contact-us',
        name: 'contact-us',
        component: () => import(/* webpackChunkName: "pages-contact-us" */ '../views/sample/pages/contact_us.vue'),
    },
    {
        path: '/sample/pages/faq',
        name: 'faq',
        component: () => import(/* webpackChunkName: "pages-faq" */ '../views/sample/pages/faq.vue'),
    },
    {
        path: '/sample/pages/faq2',
        name: 'faq2',
        component: () => import(/* webpackChunkName: "pages-faq2" */ '../views/sample/pages/faq2.vue'),
    },
    {
        path: '/sample/pages/privacy-policy',
        name: 'privacy-policy',
        component: () => import(/* webpackChunkName: "pages-privacy-policy" */ '../views/sample/pages/privacy_policy.vue'),
    },
    {
        path: '/sample/pages/coming-soon',
        name: 'coming-soon',
        component: () => import(/* webpackChunkName: "pages-coming-soon" */ '../views/sample/pages/coming_soon.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/error404',
        name: 'error404',
        component: () => import(/* webpackChunkName: "pages-error404" */ '../views/sample/pages/error404.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/error500',
        name: 'error500',
        component: () => import(/* webpackChunkName: "pages-error500" */ '../views/sample/pages/error500.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/error503',
        name: 'error503',
        component: () => import(/* webpackChunkName: "pages-error503" */ '../views/sample/pages/error503.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/maintenence',
        name: 'maintenence',
        component: () => import(/* webpackChunkName: "pages-maintenence" */ '../views/sample/pages/maintenence.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/blank-page',
        name: 'blank-page',
        component: () => import(/* webpackChunkName: "pages-blank-page" */ '../views/sample/pages/blank_page.vue'),
    },
    {
        path: '/sample/pages/sample',
        name: 'sample',
        component: () => import(/* webpackChunkName: "pages-sample" */ '../views/sample/pages/sample.vue'),
    },

    //auth
    {
        path: '/sample/auth/login-boxed',
        name: 'login-boxed',
        component: () => import(/* webpackChunkName: "auth-login-boxed" */ '../views/sample/auth/login_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/register-boxed',
        name: 'register-boxed',
        component: () => import(/* webpackChunkName: "auth-register-boxed" */ '../views/sample/auth/register_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/lockscreen-boxed',
        name: 'lockscreen-boxed',
        component: () => import(/* webpackChunkName: "auth-lockscreen-boxed" */ '../views/sample/auth/lockscreen_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/pass-recovery-boxed',
        name: 'pass-recovery-boxed',
        component: () => import(/* webpackChunkName: "auth-pass-recovery-boxed" */ '../views/sample/auth/pass_recovery_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/login',
        name: 'login',
        component: () => import(/* webpackChunkName: "auth-login" */ '../views/sample/auth/login.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/register',
        name: 'register',
        component: () => import(/* webpackChunkName: "auth-register" */ '../views/sample/auth/register.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/lockscreen',
        name: 'lockscreen',
        component: () => import(/* webpackChunkName: "auth-lockscreen" */ '../views/sample/auth/lockscreen.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/pass-recovery',
        name: 'pass-recovery',
        component: () => import(/* webpackChunkName: "auth-pass-recovery" */ '../views/sample/auth/pass_recovery.vue'),
        meta: { layout: 'auth' },
    },

    //elements
    {
        path: '/sample/elements/alerts',
        name: 'alerts',
        component: () => import(/* webpackChunkName: "elements-alerts" */ '../views/sample/elements/alerts.vue'),
    },
    {
        path: '/sample/elements/avatar',
        name: 'avatar',
        component: () => import(/* webpackChunkName: "elements-avatar" */ '../views/sample/elements/avatar.vue'),
    },
    {
        path: '/sample/elements/badges',
        name: 'badges',
        component: () => import(/* webpackChunkName: "elements-badges" */ '../views/sample/elements/badges.vue'),
    },
    {
        path: '/sample/elements/breadcrumbs',
        name: 'breadcrumbs',
        component: () => import(/* webpackChunkName: "elements-breadcrumbs" */ '../views/sample/elements/breadcrumbs.vue'),
    },
    {
        path: '/sample/elements/buttons',
        name: 'buttons',
        component: () => import(/* webpackChunkName: "elements-buttons" */ '../views/sample/elements/buttons.vue'),
    },
    {
        path: '/sample/elements/buttons-group',
        name: 'buttons-group',
        component: () => import(/* webpackChunkName: "elements-buttons-group" */ '../views/sample/elements/buttons_group.vue'),
    },
    {
        path: '/sample/elements/color-library',
        name: 'color-library',
        component: () => import(/* webpackChunkName: "elements-color-library" */ '../views/sample/elements/color_library.vue'),
    },
    {
        path: '/sample/elements/dropdown',
        name: 'dropdown',
        component: () => import(/* webpackChunkName: "elements-dropdown" */ '../views/sample/elements/dropdown.vue'),
    },
    {
        path: '/sample/elements/infobox',
        name: 'infobox',
        component: () => import(/* webpackChunkName: "elements-infobox" */ '../views/sample/elements/infobox.vue'),
    },
    {
        path: '/sample/elements/jumbotron',
        name: 'jumbotron',
        component: () => import(/* webpackChunkName: "elements-jumbotron" */ '../views/sample/elements/jumbotron.vue'),
    },
    {
        path: '/sample/elements/loader',
        name: 'loader',
        component: () => import(/* webpackChunkName: "elements-loader" */ '../views/sample/elements/loader.vue'),
    },
    {
        path: '/sample/elements/pagination',
        name: 'pagination',
        component: () => import(/* webpackChunkName: "elements-pagination" */ '../views/sample/elements/pagination.vue'),
    },
    {
        path: '/sample/elements/popovers',
        name: 'popovers',
        component: () => import(/* webpackChunkName: "elements-popovers" */ '../views/sample/elements/popovers.vue'),
    },
    {
        path: '/sample/elements/progress-bar',
        name: 'progress-bar',
        component: () => import(/* webpackChunkName: "elements-progress-bar" */ '../views/sample/elements/progress_bar.vue'),
    },
    {
        path: '/sample/elements/search',
        name: 'search',
        component: () => import(/* webpackChunkName: "elements-search" */ '../views/sample/elements/search.vue'),
    },
    {
        path: '/sample/elements/tooltips',
        name: 'tooltips',
        component: () => import(/* webpackChunkName: "elements-tooltips" */ '../views/sample/elements/tooltips.vue'),
    },
    {
        path: '/sample/elements/treeview',
        name: 'treeview',
        component: () => import(/* webpackChunkName: "elements-treeview" */ '../views/sample/elements/treeview.vue'),
    },
    {
        path: '/sample/elements/typography',
        name: 'typography',
        component: () => import(/* webpackChunkName: "elements-typography" */ '../views/sample/elements/typography.vue'),
    },

    //tables
    {
        path: '/sample/tables',
        name: 'tables',
        component: () => import(/* webpackChunkName: "tables" */ '../views/sample/tables.vue'),
    },

    //users
    {
        path: '/sample/users/profile',
        name: 'profile',
        component: () => import(/* webpackChunkName: "users-profile" */ '../views/sample/users/profile.vue'),
    },
    {
        path: '/sample/users/account-setting',
        name: 'account-setting',
        component: () => import(/* webpackChunkName: "users-account-setting" */ '../views/sample/users/account_setting.vue'),
    },

    //drag&drop
    {
        path: '/sample/dragndrop',
        name: 'dragndrop',
        component: () => import(/* webpackChunkName: "dragndrop" */ '../views/sample/dragndrop.vue'),
    },

    //charts
    {
        path: '/sample/charts/apex-chart',
        name: 'apex-chart',
        component: () => import(/* webpackChunkName: "charts-apex-chart" */ '../views/sample/charts/apex_chart.vue'),
    },

    //widgets
    {
        path: '/sample/widgets',
        name: 'widgets',
        component: () => import(/* webpackChunkName: "widgets" */ '../views/sample/widgets.vue'),
    },

    //forms
    {
        path: '/sample/forms/basic',
        name: 'basic',
        component: () => import(/* webpackChunkName: "forms-basic" */ '../views/sample/forms/basic.vue'),
    },
    {
        path: '/sample/forms/input-group',
        name: 'input-group',
        component: () => import(/* webpackChunkName: "forms-input-group" */ '../views/sample/forms/input_group.vue'),
    },
    {
        path: '/sample/forms/layouts',
        name: 'layouts',
        component: () => import(/* webpackChunkName: "forms-layouts" */ '../views/sample/forms/layouts.vue'),
    },
    {
        path: '/sample/forms/validation',
        name: 'validation',
        component: () => import(/* webpackChunkName: "forms-validation" */ '../views/sample/forms/validation.vue'),
    },
    {
        path: '/sample/forms/checkbox-radio',
        name: 'checkbox-radio',
        component: () => import(/* webpackChunkName: "forms-checkbox-radio" */ '../views/sample/forms/checkbox_radio.vue'),
    },
    {
        path: '/sample/forms/switches',
        name: 'switches',
        component: () => import(/* webpackChunkName: "forms-switches" */ '../views/sample/forms/switches.vue'),
    },
    {
        path: '/sample/forms/wizards',
        name: 'wizards',
        component: () => import(/* webpackChunkName: "forms-wizards" */ '../views/sample/forms/wizards.vue'),
    },
    {
        path: '/sample/forms/file-upload',
        name: 'file-upload',
        component: () => import(/* webpackChunkName: "forms-file-upload" */ '../views/sample/forms/fileupload.vue'),
    },
    {
        path: '/sample/forms/clipboard',
        name: 'clipboard',
        component: () => import(/* webpackChunkName: "forms-clipboard" */ '../views/sample/forms/clipboard.vue'),
    },
    {
        path: '/sample/forms/date-picker',
        name: 'date-picker',
        component: () => import(/* webpackChunkName: "forms-date-picker" */ '../views/sample/forms/date_range_picker.vue'),
    },
    {
        path: '/sample/forms/input-mask',
        name: 'input-mask',
        component: () => import(/* webpackChunkName: "forms-input-mask" */ '../views/sample/forms/input_mask.vue'),
    },
    {
        path: '/sample/forms/quill-editor',
        name: 'quill-editor',
        component: () => import(/* webpackChunkName: "forms-quill-editor" */ '../views/sample/forms/quill_editor.vue'),
    },
    {
        path: '/sample/forms/touchspin',
        name: 'touchspin',
        component: () => import(/* webpackChunkName: "forms-touchspin" */ '../views/sample/forms/touchspin.vue'),
    },
    {
        path: '/sample/forms/markdown-editor',
        name: 'markdown-editor',
        component: () => import(/* webpackChunkName: "forms-markdown-editor" */ '../views/sample/forms/markdown_editor.vue'),
    },
    {
        path: '/sample/forms/select2',
        name: 'select2',
        component: () => import(/* webpackChunkName: "forms-select2" */ '../views/sample/forms/select2.vue'),
    },

    //apps
    {
        path: '/sample/apps/chat',
        name: 'chat',
        component: () => import(/* webpackChunkName: "apps-chat" */ '../views/sample/apps/chat.vue'),
    },
    {
        path: '/sample/apps/mailbox',
        name: 'mailbox',
        component: () => import(/* webpackChunkName: "apps-mailbox" */ '../views/sample/apps/mailbox.vue'),
    },
    {
        path: '/sample/apps/todo-list',
        name: 'todo-list',
        component: () => import(/* webpackChunkName: "apps-todo-list" */ '../views/sample/apps/todo_list.vue'),
    },
    {
        path: '/sample/apps/contacts',
        name: 'contacts',
        component: () => import(/* webpackChunkName: "apps-contacts" */ '../views/sample/apps/contacts.vue'),
    },
    {
        path: '/sample/apps/notes',
        name: 'notes',
        component: () => import(/* webpackChunkName: "apps-notes" */ '../views/sample/apps/notes.vue'),
    },
    {
        path: '/sample/apps/scrumboard',
        name: 'scrumboard',
        component: () => import(/* webpackChunkName: "apps-scrumboard" */ '../views/sample/apps/scrumboard.vue'),
    },
    {
        path: '/sample/apps/calendar',
        name: 'calendar',
        component: () => import(/* webpackChunkName: "apps-calendar" */ '../views/sample/apps/calendar.vue'),
    },
    {
        path: '/sample/apps/invoice/list',
        name: 'invoice-list',
        component: () => import(/* webpackChunkName: "apps-invoice-list" */ '../views/sample/apps/invoice/list.vue'),
    },
    {
        path: '/sample/apps/invoice/preview',
        name: 'invoice-preview',
        component: () => import(/* webpackChunkName: "apps-invoice-preview" */ '../views/sample/apps/invoice/preview.vue'),
    },
    {
        path: '/sample/apps/invoice/add',
        name: 'invoice-add',
        component: () => import(/* webpackChunkName: "apps-invoice-add" */ '../views/sample/apps/invoice/add.vue'),
    },
    {
        path: '/sample/apps/invoice/edit',
        name: 'invoice-edit',
        component: () => import(/* webpackChunkName: "apps-invoice-edit" */ '../views/sample/apps/invoice/edit.vue'),
    },

    //tables
    {
        path: '/sample/tables/basic',
        name: 'table-basic',
        component: () => import(/* webpackChunkName: "tables-basic" */ '../views/sample/tables/basic.vue'),
    },
    {
        path: '/sample/tables/striped',
        name: 'striped',
        component: () => import(/* webpackChunkName: "tables-striped" */ '../views/sample/tables/striped.vue'),
    },
    {
        path: '/sample/tables/order-sorting',
        name: 'order-sorting',
        component: () => import(/* webpackChunkName: "tables-order-sorting" */ '../views/sample/tables/order_sorting.vue'),
    },
    {
        path: '/sample/tables/multi-column',
        name: 'multi-column',
        component: () => import(/* webpackChunkName: "tables-multi-column" */ '../views/sample/tables/multi_column.vue'),
    },
    {
        path: '/sample/tables/multiple-tables',
        name: 'multiple-tables',
        component: () => import(/* webpackChunkName: "tables-multiple-tables" */ '../views/sample/tables/multiple_tables.vue'),
    },
    {
        path: '/sample/tables/alt-pagination',
        name: 'alt-pagination',
        component: () => import(/* webpackChunkName: "tables-alt-pagination" */ '../views/sample/tables/alt_pagination.vue'),
    },
    {
        path: '/sample/tables/custom',
        name: 'custom',
        component: () => import(/* webpackChunkName: "tables-custom" */ '../views/sample/tables/custom.vue'),
    },
    {
        path: '/sample/tables/range-search',
        name: 'range-search',
        component: () => import(/* webpackChunkName: "tables-range-search" */ '../views/sample/tables/range_search.vue'),
    },
    {
        path: '/sample/tables/export',
        name: 'export',
        component: () => import(/* webpackChunkName: "tables-export" */ '../views/sample/tables/export.vue'),
    },
    {
        path: '/sample/tables/live-dom-ordering',
        name: 'live-dom-ordering',
        component: () => import(/* webpackChunkName: "tables-live-dom-ordering" */ '../views/sample/tables/live_dom_ordering.vue'),
    },
    {
        path: '/sample/tables/miscellaneous',
        name: 'miscellaneous',
        component: () => import(/* webpackChunkName: "tables-miscellaneous" */ '../views/sample/tables/miscellaneous.vue'),
    },
];

const router = new createRouter({
    // mode: 'history',
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { left: 0, top: 0 };
        }
    },
});

router.beforeEach((to, from, next) => {
    if (to.meta && to.meta.layout && to.meta.layout == 'auth') {
        store.commit('setLayout', 'auth');
    } else {
        store.commit('setLayout', 'app');
    }
    next(true);
});

export default router;

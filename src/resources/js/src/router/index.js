import { createRouter, createWebHistory } from 'vue-router';

import store from '../store';
import SampleHome from '../views/sample/index.vue';

import Home from '../views/index.vue';

const routes = [
    { path: '/', name: 'Home', component: Home },
    { path: '/login', name: 'Login', component: () => import('../views/login.vue'), },
    { path: '/profile', name: 'Profile', component: () => import('../views/profile/index.vue'), },
    { path: '/profile/bank', name: 'ProfileBank', component: () => import('../views/profile/bank.vue'), },
    { path: '/profile/kids', name: 'ProfileKids', component: () => import('../views/profile/kids.vue'), },

    // ------- 以下は sample --------------------------------

    //dashboard
    { path: '/sample', name: 'Sample Home', component: SampleHome },

    {
        path: '/sample/index2',
        name: '/sample/index2',
        component: () => import(/* webpackChunkName: "index2" */ '../views/sample/index2.vue'),
    },

    //components
    {
        path: '/sample/components/tabs',
        name: '/sample/tabs',
        component: () => import(/* webpackChunkName: "components-tabs" */ '../views/sample/components/tabs.vue'),
    },
    {
        path: '/sample/components/accordions',
        name: '/sample/accordions',
        component: () => import(/* webpackChunkName: "components-accordions" */ '../views/sample/components/accordions.vue'),
    },
    {
        path: '/sample/components/modals',
        name: '/sample/modals',
        component: () => import(/* webpackChunkName: "components-modals" */ '../views/sample/components/modals.vue'),
    },
    {
        path: '/sample/components/cards',
        name: '/sample/cards',
        component: () => import(/* webpackChunkName: "components-cards" */ '../views/sample/components/cards.vue'),
    },
    {
        path: '/sample/components/carousel',
        name: '/sample/carousel',
        component: () => import(/* webpackChunkName: "components-carousel" */ '../views/sample/components/carousel.vue'),
    },

    {
        path: '/sample/components/timeline',
        name: '/sample/timeline',
        component: () => import(/* webpackChunkName: "components-timeline" */ '../views/sample/components/timeline.vue'),
    },
    {
        path: '/sample/components/media-object',
        name: '/sample/media-object',
        component: () => import(/* webpackChunkName: "components-media-object" */ '../views/sample/components/media_object.vue'),
    },
    {
        path: '/sample/components/list-group',
        name: '/sample/list-group',
        component: () => import(/* webpackChunkName: "components-list-group" */ '../views/sample/components/list_group.vue'),
    },
    {
        path: '/sample/components/pricing-table',
        name: '/sample/pricing-table',
        component: () => import(/* webpackChunkName: "components-pricing-table" */ '../views/sample/components/pricing_table.vue'),
    },
    {
        path: '/sample/components/notifications',
        name: '/sample/notifications',
        component: () => import(/* webpackChunkName: "components-notifications" */ '../views/sample/components/toast.vue'),
    },

    {
        path: '/sample/components/lightbox',
        name: '/sample/lightbox',
        component: () => import(/* webpackChunkName: "components-lightbox" */ '../views/sample/components/lightbox.vue'),
    },
    {
        path: '/sample/components/countdown',
        name: '/sample/countdown',
        component: () => import(/* webpackChunkName: "components-countdown" */ '../views/sample/components/countdown.vue'),
    },
    {
        path: '/sample/components/counter',
        name: '/sample/counter',
        component: () => import(/* webpackChunkName: "components-counter" */ '../views/sample/components/counter.vue'),
    },
    {
        path: '/sample/components/sweetalert',
        name: '/sample/sweetalert',
        component: () => import(/* webpackChunkName: "components-sweetalert" */ '../views/sample/components/sweetalert.vue'),
    },

    //fonts
    {
        path: '/sample/font-icons',
        name: '/sample/font-icons',
        component: () => import(/* webpackChunkName: "font-icons" */ '../views/sample/font_icons.vue'),
    },

    //pages
    {
        path: '/sample/pages/helpdesk',
        name: '/sample/helpdesk',
        component: () => import(/* webpackChunkName: "pages-helpdesk" */ '../views/sample/pages/helpdesk.vue'),
    },
    {
        path: '/sample/pages/contact-us',
        name: '/sample/contact-us',
        component: () => import(/* webpackChunkName: "pages-contact-us" */ '../views/sample/pages/contact_us.vue'),
    },
    {
        path: '/sample/pages/faq',
        name: '/sample/faq',
        component: () => import(/* webpackChunkName: "pages-faq" */ '../views/sample/pages/faq.vue'),
    },
    {
        path: '/sample/pages/faq2',
        name: '/sample/faq2',
        component: () => import(/* webpackChunkName: "pages-faq2" */ '../views/sample/pages/faq2.vue'),
    },
    {
        path: '/sample/pages/privacy-policy',
        name: '/sample/privacy-policy',
        component: () => import(/* webpackChunkName: "pages-privacy-policy" */ '../views/sample/pages/privacy_policy.vue'),
    },
    {
        path: '/sample/pages/coming-soon',
        name: '/sample/coming-soon',
        component: () => import(/* webpackChunkName: "pages-coming-soon" */ '../views/sample/pages/coming_soon.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/error404',
        name: '/sample/error404',
        component: () => import(/* webpackChunkName: "pages-error404" */ '../views/sample/pages/error404.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/error500',
        name: '/sample/error500',
        component: () => import(/* webpackChunkName: "pages-error500" */ '../views/sample/pages/error500.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/error503',
        name: '/sample/error503',
        component: () => import(/* webpackChunkName: "pages-error503" */ '../views/sample/pages/error503.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/maintenence',
        name: '/sample/maintenence',
        component: () => import(/* webpackChunkName: "pages-maintenence" */ '../views/sample/pages/maintenence.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/pages/blank-page',
        name: '/sample/blank-page',
        component: () => import(/* webpackChunkName: "pages-blank-page" */ '../views/sample/pages/blank_page.vue'),
    },
    {
        path: '/sample/pages/sample',
        name: '/sample/sample',
        component: () => import(/* webpackChunkName: "pages-sample" */ '../views/sample/pages/sample.vue'),
    },

    //auth
    {
        path: '/sample/auth/login-boxed',
        name: '/sample/login-boxed',
        component: () => import(/* webpackChunkName: "auth-login-boxed" */ '../views/sample/auth/login_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/register-boxed',
        name: '/sample/register-boxed',
        component: () => import(/* webpackChunkName: "auth-register-boxed" */ '../views/sample/auth/register_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/lockscreen-boxed',
        name: '/sample/lockscreen-boxed',
        component: () => import(/* webpackChunkName: "auth-lockscreen-boxed" */ '../views/sample/auth/lockscreen_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/pass-recovery-boxed',
        name: '/sample/pass-recovery-boxed',
        component: () => import(/* webpackChunkName: "auth-pass-recovery-boxed" */ '../views/sample/auth/pass_recovery_boxed.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/login',
        name: '/sample/login',
        component: () => import(/* webpackChunkName: "auth-login" */ '../views/sample/auth/login.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/register',
        name: '/sample/register',
        component: () => import(/* webpackChunkName: "auth-register" */ '../views/sample/auth/register.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/lockscreen',
        name: '/sample/lockscreen',
        component: () => import(/* webpackChunkName: "auth-lockscreen" */ '../views/sample/auth/lockscreen.vue'),
        meta: { layout: 'auth' },
    },
    {
        path: '/sample/auth/pass-recovery',
        name: '/sample/pass-recovery',
        component: () => import(/* webpackChunkName: "auth-pass-recovery" */ '../views/sample/auth/pass_recovery.vue'),
        meta: { layout: 'auth' },
    },

    //elements
    {
        path: '/sample/elements/alerts',
        name: '/sample/alerts',
        component: () => import(/* webpackChunkName: "elements-alerts" */ '../views/sample/elements/alerts.vue'),
    },
    {
        path: '/sample/elements/avatar',
        name: '/sample/avatar',
        component: () => import(/* webpackChunkName: "elements-avatar" */ '../views/sample/elements/avatar.vue'),
    },
    {
        path: '/sample/elements/badges',
        name: '/sample/badges',
        component: () => import(/* webpackChunkName: "elements-badges" */ '../views/sample/elements/badges.vue'),
    },
    {
        path: '/sample/elements/breadcrumbs',
        name: '/sample/breadcrumbs',
        component: () => import(/* webpackChunkName: "elements-breadcrumbs" */ '../views/sample/elements/breadcrumbs.vue'),
    },
    {
        path: '/sample/elements/buttons',
        name: '/sample/buttons',
        component: () => import(/* webpackChunkName: "elements-buttons" */ '../views/sample/elements/buttons.vue'),
    },
    {
        path: '/sample/elements/buttons-group',
        name: '/sample/buttons-group',
        component: () => import(/* webpackChunkName: "elements-buttons-group" */ '../views/sample/elements/buttons_group.vue'),
    },
    {
        path: '/sample/elements/color-library',
        name: '/sample/color-library',
        component: () => import(/* webpackChunkName: "elements-color-library" */ '../views/sample/elements/color_library.vue'),
    },
    {
        path: '/sample/elements/dropdown',
        name: '/sample/dropdown',
        component: () => import(/* webpackChunkName: "elements-dropdown" */ '../views/sample/elements/dropdown.vue'),
    },
    {
        path: '/sample/elements/infobox',
        name: '/sample/infobox',
        component: () => import(/* webpackChunkName: "elements-infobox" */ '../views/sample/elements/infobox.vue'),
    },
    {
        path: '/sample/elements/jumbotron',
        name: '/sample/jumbotron',
        component: () => import(/* webpackChunkName: "elements-jumbotron" */ '../views/sample/elements/jumbotron.vue'),
    },
    {
        path: '/sample/elements/loader',
        name: '/sample/loader',
        component: () => import(/* webpackChunkName: "elements-loader" */ '../views/sample/elements/loader.vue'),
    },
    {
        path: '/sample/elements/pagination',
        name: '/sample/pagination',
        component: () => import(/* webpackChunkName: "elements-pagination" */ '../views/sample/elements/pagination.vue'),
    },
    {
        path: '/sample/elements/popovers',
        name: '/sample/popovers',
        component: () => import(/* webpackChunkName: "elements-popovers" */ '../views/sample/elements/popovers.vue'),
    },
    {
        path: '/sample/elements/progress-bar',
        name: '/sample/progress-bar',
        component: () => import(/* webpackChunkName: "elements-progress-bar" */ '../views/sample/elements/progress_bar.vue'),
    },
    {
        path: '/sample/elements/search',
        name: '/sample/search',
        component: () => import(/* webpackChunkName: "elements-search" */ '../views/sample/elements/search.vue'),
    },
    {
        path: '/sample/elements/tooltips',
        name: '/sample/tooltips',
        component: () => import(/* webpackChunkName: "elements-tooltips" */ '../views/sample/elements/tooltips.vue'),
    },
    {
        path: '/sample/elements/treeview',
        name: '/sample/treeview',
        component: () => import(/* webpackChunkName: "elements-treeview" */ '../views/sample/elements/treeview.vue'),
    },
    {
        path: '/sample/elements/typography',
        name: '/sample/typography',
        component: () => import(/* webpackChunkName: "elements-typography" */ '../views/sample/elements/typography.vue'),
    },

    //tables
    {
        path: '/sample/tables',
        name: '/sample/tables',
        component: () => import(/* webpackChunkName: "tables" */ '../views/sample/tables.vue'),
    },

    //users
    {
        path: '/sample/users/profile',
        name: '/sample/profile',
        component: () => import(/* webpackChunkName: "users-profile" */ '../views/sample/users/profile.vue'),
    },
    {
        path: '/sample/users/account-setting',
        name: '/sample/account-setting',
        component: () => import(/* webpackChunkName: "users-account-setting" */ '../views/sample/users/account_setting.vue'),
    },

    //drag&drop
    {
        path: '/sample/dragndrop',
        name: '/sample/dragndrop',
        component: () => import(/* webpackChunkName: "dragndrop" */ '../views/sample/dragndrop.vue'),
    },

    //charts
    {
        path: '/sample/charts/apex-chart',
        name: '/sample/apex-chart',
        component: () => import(/* webpackChunkName: "charts-apex-chart" */ '../views/sample/charts/apex_chart.vue'),
    },

    //widgets
    {
        path: '/sample/widgets',
        name: '/sample/widgets',
        component: () => import(/* webpackChunkName: "widgets" */ '../views/sample/widgets.vue'),
    },

    //forms
    {
        path: '/sample/forms/basic',
        name: '/sample/basic',
        component: () => import(/* webpackChunkName: "forms-basic" */ '../views/sample/forms/basic.vue'),
    },
    {
        path: '/sample/forms/input-group',
        name: '/sample/input-group',
        component: () => import(/* webpackChunkName: "forms-input-group" */ '../views/sample/forms/input_group.vue'),
    },
    {
        path: '/sample/forms/layouts',
        name: '/sample/layouts',
        component: () => import(/* webpackChunkName: "forms-layouts" */ '../views/sample/forms/layouts.vue'),
    },
    {
        path: '/sample/forms/validation',
        name: '/sample/validation',
        component: () => import(/* webpackChunkName: "forms-validation" */ '../views/sample/forms/validation.vue'),
    },
    {
        path: '/sample/forms/checkbox-radio',
        name: '/sample/checkbox-radio',
        component: () => import(/* webpackChunkName: "forms-checkbox-radio" */ '../views/sample/forms/checkbox_radio.vue'),
    },
    {
        path: '/sample/forms/switches',
        name: '/sample/switches',
        component: () => import(/* webpackChunkName: "forms-switches" */ '../views/sample/forms/switches.vue'),
    },
    {
        path: '/sample/forms/wizards',
        name: '/sample/wizards',
        component: () => import(/* webpackChunkName: "forms-wizards" */ '../views/sample/forms/wizards.vue'),
    },
    {
        path: '/sample/forms/file-upload',
        name: '/sample/file-upload',
        component: () => import(/* webpackChunkName: "forms-file-upload" */ '../views/sample/forms/fileupload.vue'),
    },
    {
        path: '/sample/forms/clipboard',
        name: '/sample/clipboard',
        component: () => import(/* webpackChunkName: "forms-clipboard" */ '../views/sample/forms/clipboard.vue'),
    },
    {
        path: '/sample/forms/date-picker',
        name: '/sample/date-picker',
        component: () => import(/* webpackChunkName: "forms-date-picker" */ '../views/sample/forms/date_range_picker.vue'),
    },
    {
        path: '/sample/forms/input-mask',
        name: '/sample/input-mask',
        component: () => import(/* webpackChunkName: "forms-input-mask" */ '../views/sample/forms/input_mask.vue'),
    },
    {
        path: '/sample/forms/quill-editor',
        name: '/sample/quill-editor',
        component: () => import(/* webpackChunkName: "forms-quill-editor" */ '../views/sample/forms/quill_editor.vue'),
    },
    {
        path: '/sample/forms/touchspin',
        name: '/sample/touchspin',
        component: () => import(/* webpackChunkName: "forms-touchspin" */ '../views/sample/forms/touchspin.vue'),
    },
    {
        path: '/sample/forms/markdown-editor',
        name: '/sample/markdown-editor',
        component: () => import(/* webpackChunkName: "forms-markdown-editor" */ '../views/sample/forms/markdown_editor.vue'),
    },
    {
        path: '/sample/forms/select2',
        name: '/sample/select2',
        component: () => import(/* webpackChunkName: "forms-select2" */ '../views/sample/forms/select2.vue'),
    },

    //apps
    {
        path: '/sample/apps/chat',
        name: '/sample/chat',
        component: () => import(/* webpackChunkName: "apps-chat" */ '../views/sample/apps/chat.vue'),
    },
    {
        path: '/sample/apps/mailbox',
        name: '/sample/mailbox',
        component: () => import(/* webpackChunkName: "apps-mailbox" */ '../views/sample/apps/mailbox.vue'),
    },
    {
        path: '/sample/apps/todo-list',
        name: '/sample/todo-list',
        component: () => import(/* webpackChunkName: "apps-todo-list" */ '../views/sample/apps/todo_list.vue'),
    },
    {
        path: '/sample/apps/contacts',
        name: '/sample/contacts',
        component: () => import(/* webpackChunkName: "apps-contacts" */ '../views/sample/apps/contacts.vue'),
    },
    {
        path: '/sample/apps/notes',
        name: '/sample/notes',
        component: () => import(/* webpackChunkName: "apps-notes" */ '../views/sample/apps/notes.vue'),
    },
    {
        path: '/sample/apps/scrumboard',
        name: '/sample/scrumboard',
        component: () => import(/* webpackChunkName: "apps-scrumboard" */ '../views/sample/apps/scrumboard.vue'),
    },
    {
        path: '/sample/apps/calendar',
        name: '/sample/calendar',
        component: () => import(/* webpackChunkName: "apps-calendar" */ '../views/sample/apps/calendar.vue'),
    },
    {
        path: '/sample/apps/invoice/list',
        name: '/sample/invoice-list',
        component: () => import(/* webpackChunkName: "apps-invoice-list" */ '../views/sample/apps/invoice/list.vue'),
    },
    {
        path: '/sample/apps/invoice/preview',
        name: '/sample/invoice-preview',
        component: () => import(/* webpackChunkName: "apps-invoice-preview" */ '../views/sample/apps/invoice/preview.vue'),
    },
    {
        path: '/sample/apps/invoice/add',
        name: '/sample/invoice-add',
        component: () => import(/* webpackChunkName: "apps-invoice-add" */ '../views/sample/apps/invoice/add.vue'),
    },
    {
        path: '/sample/apps/invoice/edit',
        name: '/sample/invoice-edit',
        component: () => import(/* webpackChunkName: "apps-invoice-edit" */ '../views/sample/apps/invoice/edit.vue'),
    },

    //tables
    {
        path: '/sample/tables/basic',
        name: '/sample/table-basic',
        component: () => import(/* webpackChunkName: "tables-basic" */ '../views/sample/tables/basic.vue'),
    },
    {
        path: '/sample/tables/striped',
        name: '/sample/striped',
        component: () => import(/* webpackChunkName: "tables-striped" */ '../views/sample/tables/striped.vue'),
    },
    {
        path: '/sample/tables/order-sorting',
        name: '/sample/order-sorting',
        component: () => import(/* webpackChunkName: "tables-order-sorting" */ '../views/sample/tables/order_sorting.vue'),
    },
    {
        path: '/sample/tables/multi-column',
        name: '/sample/multi-column',
        component: () => import(/* webpackChunkName: "tables-multi-column" */ '../views/sample/tables/multi_column.vue'),
    },
    {
        path: '/sample/tables/multiple-tables',
        name: '/sample/multiple-tables',
        component: () => import(/* webpackChunkName: "tables-multiple-tables" */ '../views/sample/tables/multiple_tables.vue'),
    },
    {
        path: '/sample/tables/alt-pagination',
        name: '/sample/alt-pagination',
        component: () => import(/* webpackChunkName: "tables-alt-pagination" */ '../views/sample/tables/alt_pagination.vue'),
    },
    {
        path: '/sample/tables/custom',
        name: '/sample/custom',
        component: () => import(/* webpackChunkName: "tables-custom" */ '../views/sample/tables/custom.vue'),
    },
    {
        path: '/sample/tables/range-search',
        name: '/sample/range-search',
        component: () => import(/* webpackChunkName: "tables-range-search" */ '../views/sample/tables/range_search.vue'),
    },
    {
        path: '/sample/tables/export',
        name: '/sample/export',
        component: () => import(/* webpackChunkName: "tables-export" */ '../views/sample/tables/export.vue'),
    },
    {
        path: '/sample/tables/live-dom-ordering',
        name: '/sample/live-dom-ordering',
        component: () => import(/* webpackChunkName: "tables-live-dom-ordering" */ '../views/sample/tables/live_dom_ordering.vue'),
    },
    {
        path: '/sample/tables/miscellaneous',
        name: '/sample/miscellaneous',
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

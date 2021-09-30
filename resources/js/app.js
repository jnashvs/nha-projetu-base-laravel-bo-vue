/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//require('bootstrap');
require('admin-lte');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./backoffice-components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./backoffice-components/ExampleComponent.vue').default);
Vue.component('dropzone-component', require('./backoffice-components/Dropzone.vue').default);
Vue.component('filetypes-component', require('./backoffice-components/FileTypes.vue').default);
Vue.component('my-input', require('./backoffice-components/MyInput.vue').default);
Vue.component('bo-file-input', require('./backoffice-components/form/BoFileInput.vue').default);
Vue.component('alert-success', require('./backoffice-components/alerts/AlertSuccess.vue').default);

import Multiselect from "vue-multiselect";

// register globally
Vue.component("multiselect", Multiselect);

// image v-lazy-load
import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload, {
    preLoad: 1.3,
    //   error: errorimage,
    //   loading: loadimage,
    attempt: 1
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueRouter from 'vue-router'

import { ClientTable, Event } from 'vue-tables-2';
Vue.use(ClientTable, Event);

Vue.use(VueRouter)

var router = new VueRouter({
    mode: 'history',
    routes: []
});

const app = new Vue({
    router,
    el: '#app',
});
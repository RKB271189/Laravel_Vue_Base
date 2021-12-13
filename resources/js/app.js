/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.purify = o => JSON.parse(JSON.stringify(o))
let token = document.head.querySelector('meta[name="csrf-token"]')
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found')
}
let date_format = document.head.querySelector('meta[name="dp-date"]')
let time_format = document.head.querySelector('meta[name="dp-time"]')
let datetime_format = document.head.querySelector('meta[name="dp-datetime"]')
let app_locale = document.head.querySelector('meta[name="app-locale"]')

if (date_format && time_format && datetime_format) {
    window.date_format_moment = date_format.content
    window.time_format_moment = time_format.content
    window.datetime_format_moment = datetime_format.content
    window.app_locale = app_locale.content
} else {
    console.error('Moment.js date and time formats not found')
}
//window.Vue = require('vue');
import Vue from 'vue';

Vue.prototype.$eventHub = new Vue();
import router from './routes';
import store from './store';
import Datatable from 'vue2-datatable-component';
import VueAWN from 'vue-awesome-notifications';
import VuesweetAlert from 'vue-sweetalert2';




Vue.use(Datatable);
Vue.use(VueAWN, {
    position: 'top-right'
});
Vue.use(VuesweetAlert);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('eventhub-component', require('./components/Extra/EventhubComponent.vue').default);
Vue.component('loadingtable-component', require('./components/Extra/LoadingtableComponent.vue').default);
Vue.component('loadingoverlay-component', require('./components/Extra/LoadingoverlayComponent.vue').default);
Vue.component('cardheader-component', require('./components/Extra/CardheaderComponent.vue').default);
Vue.component('cardfooter-component', require('./components/Extra/CardfooterComponent.vue').default);
Vue.component('inputtext-component', require('./components/Extra/InputtextComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    data: {
        relationships: {
        },
        dpconfigDate: {
            format: window.date_format_moment
        },
        dpconfigTime: {
            format: window.time_format_moment
        },
        dpconfigDatetime: {
            format: window.datetime_format_moment,
            sideBySide: true
        }
    },
    router,
    store
}).$mount('#app');

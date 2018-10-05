
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('app', require('./components/app'));
Vue.component('sections', require('./components/Sections.vue'));
Vue.component('mobile-sections', require('./components/MobileSections.vue'));
Vue.component('Tops', require('./components/sections/Tops.vue'));
Vue.component('Newsbar', require('./components/sections/Newsbar.vue'));

const app = new Vue({
    el: '#app'
});

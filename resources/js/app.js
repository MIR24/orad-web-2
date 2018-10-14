
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

// Vue.component('app', require('./components/App'));
// Vue.component('sections', require('./components/Sections'));
// Vue.component('mobile-sections', require('./components/MobileSections'));
// Vue.component('Tops', require('./components/sections/Tops'));
// Vue.component('Newsbar', require('./components/sections/Newsbar'));
// Vue.component('Auth', require('./components/sections/Auth'));
// Vue.component('Currency', require('./components/sections/Currency'));
// Vue.component('Photo', require('./components/sections/Photo'));
// Vue.component('Promo', require('./components/sections/Promo'));
// Vue.component('Ticker', require('./components/sections/Ticker'));
// Vue.component('Urgent', require('./components/sections/Urgent'));
// Vue.component('UrgentOrbit', require('./components/sections/UrgentOrbit'));
// Vue.component('Weather', require('./components/sections/Weather'));

const app = new Vue({
    el: '#app'
});

require('./bootstrap');

window.Vue = require('vue');

Vue.component('vigenere', require('./Vigenere.vue').default);

const app = new Vue({
    el: '#app'
});
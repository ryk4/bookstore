require('./bootstrap');

require('alpinejs');


import Vue from 'vue';

Vue.component('comments-index',require('./components/Comments/Index.vue').default);

const app = new Vue({
   el: '#app'
});

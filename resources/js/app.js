require('./bootstrap');

require('alpinejs');


import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.component('ratings-index',require('./components/Ratings/Index.vue').default);
Vue.component('comments-index',require('./components/Comments/Index.vue').default);

const app = new Vue({
   el: '#app'
});

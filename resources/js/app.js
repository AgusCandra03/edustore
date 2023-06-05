require('./bootstrap');

window.Vue = require('vue').default;

import Multiselect from 'vue-multiselect';

import 'vue-multiselect/dist/vue-multiselect.min.css';

Vue.component('multiselect', Multiselect)
Vue.component('sale-add', require('./components/SaleAdd.vue').default);

const app = new Vue({
    el: '#app',
});

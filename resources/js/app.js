require('./bootstrap.js');
import Vue from 'vue';

import DtrLguNabua from './DtrLguNabua.vue';

const app = new Vue({
    el    : '#dtr-lgu-nabua',
    render: h => h(DtrLguNabua)
});

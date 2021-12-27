require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router'
import Vue from 'vue'
import Blogheader from './components/Blogheader'

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    components:{
        Blogheader
    }
});

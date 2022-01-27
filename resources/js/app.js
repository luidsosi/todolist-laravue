require('./bootstrap');
import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

// window.Vue = require('vue').default;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(VueAxios, axios);
Vue.component('todo', require('./components/Todo.vue').default);

const app = new Vue({
    el: '#app',
});

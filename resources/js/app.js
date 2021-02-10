/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './components/App.vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);
// Vue.axios.defaults.baseURL = `${process.env.MIX_VUE_APP_BASE_URL}:${8000}/api`;
Vue.axios.defaults.baseURL = `http://localhost:8000/api`;

import productList from './products/list.vue';
import addProduct from './products/add.vue';
import editProduct from './products/edit.vue';

import categoryList from './categories/list.vue';
import addCategory from './categories/add.vue';
import editCategory from './categories/edit.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'products',
            path: '/product',
            component: productList
        },
        {
            name: 'add_product',
            path: '/product/create',
            component: addProduct
        },
        {
            name: 'edit_product',
            path: '/product/edit/:id',
            component: editProduct
        },
        {
            name: 'categories',
            path: '/category',
            component: categoryList
        },
        {
            name: 'add_category',
            path: '/category/create',
            component: addCategory
        },
        {
            name: 'edit_category',
            path: '/category/edit/:id',
            component: editCategory
        }
    ]
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});


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

Vue.component('delete-resource', require('./components/DeleteResourceComponent.vue'));

const app = new Vue({
    el: '#app'
});

const photoGrid = new Vue({
    el: '.photo-edit-grid',
    created: function() {
        console.log(this);
    },
    methods: {
        addFileInput: function() {
            alert("Adding new file input field");
        }
    }
})



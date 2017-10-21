
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.firebase = require('firebase');
window.Vue = require('vue');
window.toastr = require('toastr');
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

firebase.initializeApp({
    apiKey: "AIzaSyAcakBCFW_yg7DIorj_Icgj056BLkVXtyM",
    authDomain: "insitehub-7c4a4.firebaseapp.com",
    databaseURL: "https://insitehub-7c4a4.firebaseio.com",
    projectId: "insitehub-7c4a4",
    storageBucket: "insitehub-7c4a4.appspot.com",
    messagingSenderId: "599946771340"
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

toastr.options = {
    "positionClass": "toast-top-full-width",
    "preventDuplicates": true,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$(function() {
    $('#login').on('click', function () {
        let email = $('#email').val().trim();
        let password = $('#password').val().trim();
        console.log({ 'email': email, 'password': password});
        firebase.auth().signInWithEmailAndPassword(email, password)
            .then(data => {
                console.log(data.He);
                axios.post('/check_login', {
                    token: data.He
                })
                    .then(() => {
                        window.location = '/';
                    })
                    .catch(error => { console.error(error); toastr.error(error.message); });
            })
            .catch(error =>{ console.error({'code': error.code, 'message': error.message}); toastr.error(error.message); });
    });
});
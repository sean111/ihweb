
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.firebase = require('firebase');
window.Vue = require('vue');

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

$(function() {
    $('#login').on('click', function () {
        firebase.auth().signInWithEmailAndPassword($('#email').val(), $('#password').val())
            .catch(error => console.error({'code': error.code, 'message': error.message}));
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                console.debug(user.He);
                axios.post('/check_login', {
                    token: user.He
                })
                    .then(() => window.location = '/')
                    .catch(error => console.error(error));
            } else {
                console.log('User signed out');
            }
        });
    });
});
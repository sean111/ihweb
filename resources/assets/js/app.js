
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

$('#login').on('click', function () {
    console.log('pre firebase');
    firebase.auth().signInWithEmailAndPassword($('#email').val(), $('#password').val())
        .then(function () {
            console.log('Test')
        })
        .catch(error => console.error({'code': error.code, 'message': error.message}));
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

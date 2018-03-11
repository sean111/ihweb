require('bootstrap');
require('bootstrap-colorpicker');
import swal from 'sweetalert2'
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
// window.Vue = require('vue');
// import BootstrapVue from 'bootstrap-vue'
// Vue.use(BootstrapVue);
//
// const app = new Vue({
//     el: '#vue-app'
// });

/*****
 * CONFIGURATION
 */
//Main navigation
$.navigation = $('nav > ul.nav');

$.panelIconOpened = 'icon-arrow-up';
$.panelIconClosed = 'icon-arrow-down';

//Default colours
$.brandPrimary =  '#20a8d8';
$.brandSuccess =  '#4dbd74';
$.brandInfo =     '#63c2de';
$.brandWarning =  '#f8cb00';
$.brandDanger =   '#f86c6b';

$.grayDark =      '#2a2c36';
$.gray =          '#55595c';
$.grayLight =     '#818a91';
$.grayLighter =   '#d1d4d7';
$.grayLightest =  '#f8f9fa';

'use strict';

/****
 * MAIN NAVIGATION
 */

$(document).ready(function($){

    // Add class .active to current link
    $.navigation.find('a').each(function(){

        var cUrl = String(window.location).split('?')[0];

        if (cUrl.substr(cUrl.length - 1) == '#') {
            cUrl = cUrl.slice(0,-1);
        }

        if ($($(this))[0].href==cUrl) {
            $(this).addClass('active');

            $(this).parents('ul').add(this).each(function(){
                $(this).parent().addClass('open');
            });
        }
    });

    // Dropdown Menu
    $.navigation.on('click', 'a', function(e){

        if ($.ajaxLoad) {
            e.preventDefault();
        }

        if ($(this).hasClass('nav-dropdown-toggle')) {
            $(this).parent().toggleClass('open');
            resizeBroadcast();
        }

    });

    function resizeBroadcast() {

        var timesRun = 0;
        var interval = setInterval(function(){
            timesRun += 1;
            if(timesRun === 5){
                clearInterval(interval);
            }
            window.dispatchEvent(new Event('resize'));
        }, 62.5);
    }

    /* ---------- Main Menu Open/Close, Min/Full ---------- */
    $('.sidebar-toggler').click(function(){
        $('body').toggleClass('sidebar-hidden');
        resizeBroadcast();
    });

    $('.sidebar-minimizer').click(function(){
        $('body').toggleClass('sidebar-minimized');
        resizeBroadcast();
    });

    $('.brand-minimizer').click(function(){
        $('body').toggleClass('brand-minimized');
    });

    $('.aside-menu-toggler').click(function(){
        $('body').toggleClass('aside-menu-hidden');
        resizeBroadcast();
    });

    $('.mobile-sidebar-toggler').click(function(){
        $('body').toggleClass('sidebar-mobile-show');
        resizeBroadcast();
    });

    $('.sidebar-close').click(function(){
        $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
    });

    /* ---------- Disable moving to top ---------- */
    $('a[href="#"][data-top!=true]').click(function(e){
        e.preventDefault();
    });

    var colorPickerTemplate = '<div class="colorpicker dropdown-menu">' +
        '<div class="colorpicker-saturation"><i><b></b></i></div>' +
        '<div class="colorpicker-hue"><i></i></div>' +
        '<div class="colorpicker-color"><div /></div>' +
        '<div class="colorpicker-selectors"></div>' + '</div>';
    $('.colorpicker-component').colorpicker({
        template: colorPickerTemplate
    });

    $('.add-answer').on('click', () => {
        $('#answer-inputs').append(`
            <div class="input-group">
                <input type='text' name='answer[]' class='form-control answer' />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-danger del-answer"><i class="fa fa-remove"></i></button>
                </span>
            </div>
        `);
    });

    let dirtyAnswer = null;
    $(document).on('blur', 'input.answer', function() {
         //find old answer and update it in select
        let newVal = $(this).val();
        if (newVal.length > 1) {
            if (dirtyAnswer.length > 0) {
                //Update old value with new one
                $(`#correct_answer option[value="${dirtyAnswer}"]`).val(newVal).html(newVal);
            } else {
                //Just append new value
                $('#correct_answer').append(`<option value='${newVal}'>${newVal}</option>`);
            }
        }
        console.log($(this).val());
        console.log('Blur!');
    }).on('focus', 'input.answer', function() {
        dirtyAnswer = $(this).val();
        console.log({dirty: dirtyAnswer});
    });

    $('body').on('click', '.del-answer', function() {
        let iGroup = $(this).parent().parent();
        let target = iGroup.find('.answer').val();
        $(`#correct_answer option[value="${target}"]`).remove();
        //Find the answer and delete it from the select
        iGroup.remove();
    });

    $('#frequency').change(function() {
        let freq = $('#frequency :selected').val();
        if (freq === 'once') {
            $('.schedule-date').show();
            $('.schedule-start').hide();
            $('.schedule-end').hide();
            $('.schedule-days').hide();
        } else {
            $('.schedule-date').hide();
            $('.schedule-start').show();
            $('.schedule-end').show();
            $('.schedule-days').show();
        }
    });

});

/****
 * CARDS ACTIONS
 */

$(document).on('click', '.card-actions a', function(e){
    e.preventDefault();

    if ($(this).hasClass('btn-close')) {
        $(this).parent().parent().parent().fadeOut();
    } else if ($(this).hasClass('btn-minimize')) {
        var $target = $(this).parent().parent().next('.card-block');
        if (!$(this).hasClass('collapsed')) {
            $('i',$(this)).removeClass($.panelIconOpened).addClass($.panelIconClosed);
        } else {
            $('i',$(this)).removeClass($.panelIconClosed).addClass($.panelIconOpened);
        }

    } else if ($(this).hasClass('btn-setting')) {
        $('#myModal').modal('show');
    }

});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function init(url) {
    /* ---------- Tooltip ---------- */
    $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
    /* ---------- Popover ---------- */
    $('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();
}

$('#defaultorg').on('change', () => {
    let value = $('#defaultorg :selected').val();
    window.location = '/admin/switch/' + value;
});

$('.resource-rename').on('click', function() {
   let id = $(this).data('id');
   $('#file_id').val(id);
   $('#resource-rename-modal').modal('show');
});

$('.resource-assign').on('click', function() {
    let id = $(this).data('id');
    $('#assign_file_id').val(id);
    $('#resource-assign-modal').modal('show');
});

$('.resource-delete').on('click', function () {
    let id = $(this).data('id');
    swal({
        title: 'Are you sure?',
        text: 'This will permanently delete the resource',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then(function () {
        window.location = '/admin/resource/delete/' + id;
    }).catch(swal.noop);
});
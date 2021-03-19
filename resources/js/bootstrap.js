import axios from 'axios';
import _ from 'lodash';
import Vue from 'vue';
import jQuery from 'jquery';
import moment from 'moment';

window.$ = window.jQuery = jQuery;
window.Vue = Vue;
window._ = _;
window.axios = axios;
window.moment = moment;

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    $(function () {
        // spinner buttons
        $('.btn-spinner').on('click', function (e) {
            if (!(e.shiftKey || e.ctrlKey || e.metaKey)) {
                $(this).css({ 'pointer-events': 'none' });
                $(this).find('i').removeClass().addClass('fa fa-spinner');
            }
        });

        // dropdown Menu
        $('.dropdown-toggle').on('click', function () {
            $(this).parent().toggleClass('open');
        });
        $('.dropdown-item').on('click', function () {
            $(this).closest('.open').removeClass('open');
        });
        $('.dropdown-menu').on('mouseleave', function () {
            $(this).parent('.dropdown').removeClass('open');
        });

        // remove empty nav titles when no children there
        $('.nav-title').filter(function () {
            return !$(this).next().hasClass('nav-item');
        }).hide();
    });
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token.content}});
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

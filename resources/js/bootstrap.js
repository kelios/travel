/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import _ from 'lodash';
import axios from 'axios';
import jQuery from 'jquery';

window.$ = window.jQuery = jQuery;
window._ = _;
window.axios = axios;
window._ = require('lodash');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

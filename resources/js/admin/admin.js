import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import {Admin} from 'craftable';
import VModal from 'vue-js-modal';
import Vue from 'vue';
import VueAgile from 'vue-agile'
import BootstrapVue from 'bootstrap-vue';
import Lang from 'laravel-vue-lang';
import {ToggleButton} from 'vue-js-toggle-button'
import './app-components/bootstrap';
import './index';
import VueResource from "vue-resource"

import 'craftable/dist/ui';

import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import store from './../store/index'


Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);

Vue.use(VueResource);

Vue.component('multiselect', Multiselect);
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.use(VModal, {dialog: true, dynamic: true, injectModalsContainer: true});
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);
Vue.use(BootstrapVue);
Vue.use(VueAgile)
Vue.component('ToggleButton', ToggleButton)

Vue.use(Lang, {
    locale: 'ru',
    fallback: 'en',
    ignore: {
        fr: ['validation'],
    },
});
Vue.component('search-me-travel', require('../components/SearchMeTravel.vue').default);
Vue.component('search-extended-travel', require('../components/SearchExtendedTravel.vue').default);
Vue.component('travel-last', require('../components/TravelLast.vue').default);
Vue.component('travel-list', require('../components/TravelList.vue').default);
Vue.component('travel-card', require('../components/TravelCard.vue').default);
Vue.component('travel-show-section', require('../components/TravelShowSection.vue').default);
Vue.component('travel-show-list', require('../components/TravelShowList.vue').default);
Vue.component('travel-show-menu', require('../components/TravelShowMenu.vue').default);
Vue.component('travel-show-filter', require('../components/TravelShowFilter.vue').default);
Vue.component('travel-card-last', require('../components/TravelCardLast.vue').default);
Vue.component('map-me-travel', require('../components/mapMeTravel.vue').default);
Vue.component('slider', require('../components/Slider.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('feedback-form', require('../components/FeedbackForm.vue').default);
Vue.component('comments', require('../components/Comments.vue').default);
Vue.component('comment', require('../components/Comment.vue').default);
Vue.component('comment-list', require('../components/CommentList.vue').default);
Vue.component('comment-form', require('../components/CommentForm.vue').default);
Vue.component('like-component', require('../components/LikeComponent.vue').default);
Vue.component('favorite-component', require('../components/FavoriteComponent.vue').default);
Vue.component('friend-list', require('../components/FriendList.vue').default);
Vue.component('friend-card', require('../components/FriendCard.vue').default);
Vue.component('add-friend', require('../components/AddFriend.vue').default);

Vue.component('passport-clients', require('../components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('../components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('../components/passport/PersonalAccessTokens.vue'));

new Vue({
    mixins: [Admin],
    el: '#app',
    store
});

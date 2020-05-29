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
import BootstrapVue from 'bootstrap-vue'

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import store from './../store/index'


Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);

Vue.component('multiselect', Multiselect);
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.use(VModal, {dialog: true, dynamic: true, injectModalsContainer: true});
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);
Vue.use(BootstrapVue)
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

Vue.component('search-me-travel', require('../components/SearchMeTravel.vue').default);
Vue.component('travel-last', require('../components/TravelLast.vue').default);
Vue.component('travel-list', require('../components/TravelList.vue').default);
Vue.component('travel-card', require('../components/TravelCard.vue').default);
Vue.component('travel-show-section', require('../components/TravelShowSection.vue').default);
Vue.component('travel-show-list', require('../components/TravelShowList.vue').default);
Vue.component('travel-show-menu', require('../components/TravelShowMenu.vue').default);
Vue.component('travel-show-filter', require('../components/TravelShowFilter.vue').default);
Vue.component('travel-card-last', require('../components/TravelCardLast.vue').default);
Vue.component('map-me-travel', require('../components/mapMeTravel.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('feedback-form', require('../components/FeedbackForm.vue').default);

new Vue({
    mixins: [Admin],
    el: '#app',
    store
});

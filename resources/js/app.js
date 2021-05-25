import './bootstrap';

import VeeValidate from 'vee-validate';
import VueSocialSharing from 'vue-social-sharing';
import Embed from 'v-video-embed';
import Notifications from 'vue-notification';

Vue.use(VueSocialSharing);
Vue.use(VeeValidate, {strict: true});//don't del
Vue.use(Embed);
Vue.use(Notifications);

import store from './store/index';

import {Lang} from 'laravel-vue-lang';


Vue.component('travel-show-menu', () => import('./components/TravelShowMenu.vue'));
Vue.component('favorite-component', () => import('./components/FavoriteComponent.vue'));
Vue.component('like-component', () => import('./components/LikeComponent.vue'));
Vue.component('travel-show-list', () => import('./components/TravelShowList.vue'));

Vue.component('pagination', () => import('laravel-vue-pagination'));
Vue.component('feedback-form', () => import('./components/FeedbackForm.vue'));
Vue.component('message-list', () => import('./components/MessageList.vue'));
Vue.component('message-component', () => import('./components/MessageComponent.vue'));
Vue.component('upload-image-drag', () => import('./components/UploadImageDrag.vue'));

Vue.component('add-friend', () => import('./components/AddFriend.vue'));
Vue.component('friend-list', () => import('./components/FriendList.vue'));

Vue.component('search-me-travel', () => import('./components/SearchMeTravel.vue'));
Vue.component('search-extended-travel', () => import('./components/SearchExtendedTravel.vue'));
Vue.component('travel-last', () => import('./components/TravelLast.vue'));
Vue.component('travel-list', () => import('./components/TravelList.vue'));

Vue.component('travel-show-menu', () => import('./components/TravelShowMenu.vue'));
Vue.component('map-me-travel', () => import('./components/mapMeTravel.vue'));

Vue.component('media-upload', () => import('./components/MediaUpload.vue'));
Vue.component('travel-form', () => import('./components/TravelForm.vue'));
Vue.component('user-form', () => import('./components/UserForm.vue'));

Vue.component('form-search', () => import('./components/mapSearch/FormSearch.vue'));

////

Vue.component('passport-clients', () => import('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', () => import('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', () => import('./components/passport/PersonalAccessTokens.vue'));
Vue.prototype.authUserId = document.head.querySelector("meta[name='user-id']") ?
    document.head.querySelector("meta[name='user-id']").content : '';
Vue.prototype.authUserName = document.head.querySelector("meta[name='user-name']") ?
    document.head.querySelector("meta[name='user-name']").content : '';
Vue.prototype.authUserAvatar = document.head.querySelector("meta[name='user-avatar-thumb-url']") ?
    document.head.querySelector("meta[name='user-avatar-thumb-url']").content : '';

Vue.use(Lang, {
    locale: 'ru',
    fallback: 'ru',

});

new Vue({
    el: '#app',
    store,

});

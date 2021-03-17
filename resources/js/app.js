import './bootstrap';

import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';

import 'flatpickr/dist/flatpickr.css';

import VModal from 'vue-js-modal';
import Vue from 'vue';

import VueResource from "vue-resource";
import VueSocialSharing from 'vue-social-sharing'


import store from './store/index'
import 'craftable/dist/ui';
import './app-components/bootstrap';
import './index';

Vue.use(VueResource);

Vue.component('datetime', flatPickr);
Vue.use(VModal, {dialog: true, dynamic: true, injectModalsContainer: true});
Vue.use(VueQuillEditor);
Vue.use(Notifications);

Vue.use(VueSocialSharing);


Vue.component('search-me-travel', () => import('./components/SearchMeTravel.vue'));
Vue.component('search-extended-travel', () => import('./components/SearchExtendedTravel.vue'));
Vue.component('travel-last', () => import('./components/TravelLast.vue'));

Vue.component('travel-list', () => import('./components/TravelList.vue'));
Vue.component('travel-card', () => import('./components/TravelCard.vue'));

Vue.component('travel-show-list', () => import('./components/TravelShowList.vue'));
Vue.component('travel-show-menu', () => import('./components/TravelShowMenu.vue'));
Vue.component('travel-show-filter', () => import('./components/TravelShowFilter.vue'));
Vue.component('travel-card-last', () => import('./components/TravelCardLast.vue'));
Vue.component('map-me-travel', () => import('./components/mapMeTravel.vue'));
Vue.component('slider', () => import('./components/Slider.vue'));
Vue.component('pagination', () => import('laravel-vue-pagination'));
Vue.component('feedback-form', () => import('./components/FeedbackForm.vue'));
Vue.component('comments', () => import('./components/Comments.vue'));
Vue.component('comment', () => import('./components/Comment.vue'));
Vue.component('comment-list', () => import('./components/CommentList.vue'));
Vue.component('comment-form', () => import('./components/CommentForm.vue'));
Vue.component('like-component', () => import('./components/LikeComponent.vue'));
Vue.component('favorite-component', () => import('./components/FavoriteComponent.vue'));
Vue.component('friend-list', () => import('./components/FriendList.vue'));
Vue.component('friend-card', () => import('./components/FriendCard.vue'));
Vue.component('add-friend', () => import('./components/AddFriend.vue'));
Vue.component('message-component', () => import('./components/MessageComponent.vue'));
Vue.component('message-modal', () => import('./components/MessageModal.vue'));
Vue.component('modal', () => import('./components/Modal.vue'));
Vue.component('message-list', () => import('./components/MessageList.vue'));
Vue.component('message-between-list', () => import('./components/MessageBetweenList.vue'));
Vue.component('message-send', () => import('./components/MessageSend.vue'));
Vue.component('upload-image-drag', () => import('./components/UploadImageDrag.vue'));
Vue.component('select-per-page', () => import('./components/SelectPerPage.vue'));

Vue.component('passport-clients', () => import('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', () => import('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', () => import('./components/passport/PersonalAccessTokens.vue'));


Vue.prototype.translate = require('./VueTranslation/Translation').default.translate;

if (document.head.querySelector("meta[name='user-id']")) {
    Vue.prototype.authUserId = document.head.querySelector("meta[name='user-id']").content || '';
    Vue.prototype.authUserName = document.head.querySelector("meta[name='user-name']").content;
    Vue.prototype.authUserAvatar = document.head.querySelector("meta[name='user-avatar-thumb-url']").content;
}

new Vue({
    el: '#app',
    store
});

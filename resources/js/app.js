import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import store from './store';
//import router from './router';
//import TravelList from './components/TravelList.vue';
//import SearchExtendedTravel from './components/SearchExtendedTravel.vue';


import TravelShowMenu from './components/TravelShowMenu.vue';
import LikeComponent from './components/LikeComponent.vue';
import FavoriteComponent from './components/FavoriteComponent.vue';
import TravelShowList from './components/TravelShowList.vue';
import  FeedbackForm from './components/FeedbackForm.vue';
import  MessageList from './components/MessageList.vue';
import  MessageComponent from './components/MessageComponent.vue';
import  UploadImageDrag from './components/UploadImageDrag.vue';
import AddFriend from './components/AddFriend.vue';
import FriendList from './components/FriendList.vue';
import SearchMeTravel from './components/SearchMeTravel.vue';
import SearchExtendedTravel from './components/SearchExtendedTravel.vue';
import  TravelLast from './components/TravelLast.vue';
import TravelList from './components/TravelList.vue';
import  mapMeTravel from './components/mapMeTravel.vue';
import  MediaUpload from './components/MediaUpload.vue';
import TravelForm from './components/TravelForm.vue';
import  UserForm from './components/UserForm.vue';
import  FormSearch from './components/mapSearch/FormSearch.vue';


import  Clients from './components/passport/Clients.vue';
import  AuthorizedClients from './components/passport/AuthorizedClients.vue';
import  PersonalAccessTokens from './components/passport/PersonalAccessTokens.vue';


// Root vue component

//Create the app
//const app = createApp(TravelList)
createApp(TravelList)
    .mount(store)
    .mount("#app");
/*
app
    .component('travel-show-menu', TravelShowMenu)
    .component('favorite-component', FavoriteComponent)
    .component('like-component', LikeComponent)
    .component('travel-show-list', TravelShowList)
    .component('feedback-form', FeedbackForm)
    .component('message-list', MessageList)
    .component('message-component', MessageComponent)
    .component('upload-image-drag', UploadImageDrag)
    .component('add-friend', AddFriend)
    .component('friend-list', FriendList)
    .component('search-me-travel', SearchMeTravel)
    .component('search-extended-travel', SearchExtendedTravel)
    .component('travel-last', TravelLast)
    .component('travel-list', TravelList)
    .component('map-me-travel', mapMeTravel)
    .component('media-upload', MediaUpload)
    .component('travel-form', TravelForm)
    .component('user-form', UserForm)
    .component('form-search', FormSearch)
*/
/*
app.component('passport-clients', Clients)
    .component('passport-authorized-clients', AuthorizedClients)
    .component('passport-personal-access-tokens', PersonalAccessTokens)

app.authUserId = document.head.querySelector("meta[name='user-id']") ?
    document.head.querySelector("meta[name='user-id']").content : '';
app.authUserName = document.head.querySelector("meta[name='user-name']") ?
    document.head.querySelector("meta[name='user-name']").content : '';
app.authUserAvatar = document.head.querySelector("meta[name='user-avatar-thumb-url']") ?
    document.head.querySelector("meta[name='user-avatar-thumb-url']").content : '';
*/
/*
app
    .use(store)
    .mount("#app");
*/
/*


//Vue.component('travel-show-menu', () => import('./components/TravelShowMenu.vue'));
//Vue.component('favorite-component', () => import('./components/FavoriteComponent.vue'));
//Vue.component('like-component', () => import('./components/LikeComponent.vue'));
//Vue.component('travel-show-list', () => import('./components/TravelShowList.vue'));
//Vue.component('pagination', () => import('laravel-vue-pagination'));
//Vue.component('feedback-form', () => import('./components/FeedbackForm.vue'));
//Vue.component('message-list', () => import('./components/MessageList.vue'));
//Vue.component('message-component', () => import('./components/MessageComponent.vue'));
//Vue.component('upload-image-drag', () => import('./components/UploadImageDrag.vue'));
//Vue.component('add-friend', () => import('./components/AddFriend.vue'));
//Vue.component('friend-list', () => import('./components/FriendList.vue'));
//Vue.component('search-me-travel', () => import('./components/SearchMeTravel.vue'));
//Vue.component('search-extended-travel', () => import('./components/SearchExtendedTravel.vue'));
//Vue.component('travel-last', () => import('./components/TravelLast.vue'));
//Vue.component('travel-list', () => import('./components/TravelList.vue'));
//Vue.component('travel-show-menu', () => import('./components/TravelShowMenu.vue'));
//Vue.component('map-me-travel', () => import('./components/mapMeTravel.vue'));
//Vue.component('media-upload', () => import('./components/MediaUpload.vue'));
//Vue.component('travel-form', () => import('./components/TravelForm.vue'));
//Vue.component('user-form', () => import('./components/UserForm.vue'));
//Vue.component('form-search', () => import('./components/mapSearch/FormSearch.vue'));
//Vue.component('passport-clients', () => import('./components/passport/Clients.vue'));
//Vue.component('passport-authorized-clients', () => import('./components/passport/AuthorizedClients.vue'));
//Vue.component('passport-personal-access-tokens', () => import('./components/passport/PersonalAccessTokens.vue'));
Vue.prototype.authUserId = document.head.querySelector("meta[name='user-id']") ?
    document.head.querySelector("meta[name='user-id']").content : '';
Vue.prototype.authUserName = document.head.querySelector("meta[name='user-name']") ?
    document.head.querySelector("meta[name='user-name']").content : '';
Vue.prototype.authUserAvatar = document.head.querySelector("meta[name='user-avatar-thumb-url']") ?
    document.head.querySelector("meta[name='user-avatar-thumb-url']").content : '';
    */

/*
Vue.use(Lang, {
    locale: 'ru',
    fallback: 'ru',

});
*/



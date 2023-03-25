import './bootstrap';
import {createApp} from 'vue'

import VeeValidate from 'vee-validate';
import PeterAlbusVue from 'vue3-social-share';
import Embed from 'v-video-embed';
import Notifications from '@kyvg/vue3-notification';

//Vue.use(PeterAlbusVue);
//Vue.use(VeeValidate, {strict: true});//don't del
//Vue.use(Embed);
//Vue.use(Notifications);


import store from './store/index';
import {Lang} from 'laravel-vue-lang';
import TravelList from './components/TravelList';
import TravelLast from './components/TravelLast';

import TravelShowMenu from './components/TravelShowMenu';
import FavoriteComponent from './components/FavoriteComponent';
import LikeComponent from './components/LikeComponent';
import TravelShowList from './components/TravelShowList';
import FeedbackForm from './components/FeedbackForm';
import MessageList from './components/MessageList';
import MessageComponent from './components/MessageComponent';
import UploadImageDrag from './components/UploadImageDrag';
import AddFriend from './components/AddFriend';
import FriendList from './components/FriendList';
import SearchMeTravel from './components/SearchMeTravel';
import SearchExtendedTravel from './components/SearchExtendedTravel';

import MediaUpload from './components/MediaUpload';
import TravelForm from './components/TravelForm';
import UserForm from './components/UserForm';
import FormSearch from './components/mapSearch/FormSearch';

import Clients from './components/passport/Clients';
import AuthorizedClients from './components/passport/AuthorizedClients';
import PersonalAccessTokens from './components/passport/PersonalAccessTokens';

const app = createApp({});
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
    .component('media-upload', MediaUpload)
    .component('travel-form', TravelForm)
    .component('user-form', UserForm)
    .component('form-search', FormSearch)
    .component('passport-clients', Clients)
    .component('passport-authorized-clients', AuthorizedClients)
    .component('passport-personal-access-tokens', PersonalAccessTokens);
*/
app.config.authUserId =  document.head.querySelector("meta[name='user-id']") ?
    document.head.querySelector("meta[name='user-id']").content : '';
app.config.authUserName = document.head.querySelector("meta[name='user-name']") ?
        document.head.querySelector("meta[name='user-name']").content : '';
app.config.authUserAvatar = document.head.querySelector("meta[name='user-avatar-thumb-url']") ?
            document.head.querySelector("meta[name='user-avatar-thumb-url']").content : '';

app
    .use(Lang, {
        locale: 'ru',
        fallback: 'ru',

    })
    .use(store)
    .mount('#app')

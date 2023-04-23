/*
import Vuex from 'vuex'
import actions from './actions'
import mutations from './mutations'
import getters from './getters'
import state from "./state";

export default new Vuex.Store({
    state,
    mutations,
    getters,
    actions
})
*/

import {ACTION_TYPES} from "../constants/action-types";
import Vuex from "vuex";
import Axios from "axios";

export default Vuex.createStore({
    state: {
        travels: {},
        travel: {},
        where: [],
        query: '',
        filtersTravel: [],
        lastTravels: {},
        popularTravels: {},
        nearTravels: {},
        travelAddressArr: [],
        submitingForm: false,
        travelAddress: {
            'address': [],
            'meCoord': [],
            'city': [],
            'country': [],
            'url': []
        },
        travelComments: [],
        optionsCities: [],
        defImageTravel: '/media/metravel.jpg',
        friends: {},
        messages: {},
        messagesBetween: {data: {}},
        usersMessages: {},
        messagesBetweenNew: {},
        travelId: '',
        travelAddressIds: [],
        perPage: 20,
        lat: 50.5403576,
        lng: 19.3672883,
        optionsCountries: []
    },
    mutations: {
        [ACTION_TYPES.SET_TRAVELS]: (state, travels) => (state.travels = travels),
        [ACTION_TYPES.SET_COMMENTS]: (state, comments) => (state.travelComments = comments),
        [ACTION_TYPES.SET_LAST_TRAVELS]: (state, travels) => (state.lastTravels = travels),
        [ACTION_TYPES.SET_POPULAR_TRAVELS]: (state, popularTravels) => (state.popularTravels = popularTravels),
        [ACTION_TYPES.SET_NEAR_TRAVELS]: (state, nearTravels) => (state.nearTravels = nearTravels),

        [ACTION_TYPES.SET_OPTIONS_CITIES]: (state, optionsCities) => (state.optionsCities = optionsCities),
        [ACTION_TYPES.SET_MAP_DATA]: (state, travels) => {
            state.travelAddress.meCoord = [];
            travels.data.forEach((travel, indexMe) => {
                state.travelAddress.address.push(travel.travelAddressAdress);
                state.travelAddress.meCoord.push(travel.coordsMeTravelArr);
                state.travelAddress.url.push(travel.url);
            })
        },
        [ACTION_TYPES.SET_MAP_DATA_ADDRESS]: (state, travelsaddress) => (state.travelsaddress = travelsaddress),
        [ACTION_TYPES.UPDATE_COMMENTS]: (state, payLoad) => state.travelComments.push(payLoad['comments']),
        [ACTION_TYPES.SET_FRIENDS]: (state, friends) => (state.friends = friends),

        [ACTION_TYPES.SET_MESSAGES]: (state, messages) => (state.messages = messages),
        [ACTION_TYPES.SET_WHERE]: (state, where) => (state.where = where),
        [ACTION_TYPES.SET_QUERY]: (state, query) => (state.query = query),
        [ACTION_TYPES.SET_TRAVEL]: (state, travel) => (state.travel = travel),

        [ACTION_TYPES.SET_FILTER_TRAVEL]: (state, filtersTravel) => (state.filtersTravel = filtersTravel),
        [ACTION_TYPES.SET_FILTER_FOR_MAP]: (state, filtersTravel) => (state.filtersTravel = filtersTravel),
        [ACTION_TYPES.SET_MESSAGES_BETWEEN]: (state, messagesBetween) => (state.messagesBetween = messagesBetween),

        [ACTION_TYPES.SET_MESSAGES_BETWEEN_NEW]: (state, messagesBetweenNew) => state.messagesBetween.data.unshift(messagesBetweenNew),
        [ACTION_TYPES.SET_USERS_MESSAGES]: (state, usersMessages) => (state.usersMessages = usersMessages),
        [ACTION_TYPES.SET_TRAVEL_ID]: (state, travelId) => (state.travelId = travelId),
        [ACTION_TYPES.SET_SUBMITING_FORM]: (state, status) => (state.submitingForm = status),
        [ACTION_TYPES.SET_TRAVEL_ADDRESS_IDS]: (state, travelAddressIds) => (state.travelAddressIds = travelAddressIds),
        [ACTION_TYPES.SET_PERPAGE]: (state, perPage) => (state.perPage = perPage),
        [ACTION_TYPES.SET_LAT]: (state, lat) => (state.lat = lat),
        [ACTION_TYPES.SET_LNG]: (state, lng) => (state.lng = lng),
        [ACTION_TYPES.SET_COUNTRIES]: (state, optionsCountries) => (state.optionsCountries = optionsCountries),
        [ACTION_TYPES.REMOVE_TRAVEL]: (state, id) =>
            (state.travels = state.travels.filter((travel) => travel.id !== id)),
        /* [ACTION_TYPES.fetchTodos]: (state, todos) => (state.todos = todos),
         [ACTION_TYPES.addTodo]: (state, todo) => state.todos.unshift(todo),
         [ACTION_TYPES.deleteTodo]: (state, id) =>
             (state.todos = state.todos.filter((todo) => todo.id !== id)),
         [ACTION_TYPES.updateTodo]: (state, updatedTodo) => {
             const index = state.todos.findIndex((todo) => todo.id === updatedTodo.id);
             if (!index) return;
             state.todos.splice(index, 1, updatedTodo);
         },*/
    },
    getters: {
        travels(state) {
            return state.travels
        },
        travelComments(state) {
            return state.travelComments
        },
        lastTravels(state) {
            return state.lastTravels
        },
        travelAddress(state) {
            return state.travelAddress
        },
        travelAddressArr(state) {
            return state.travelAddressArr
        },
        submitingForm(state) {
            return state.submitingForm
        },
        optionsCities(state) {
            return state.optionsCities
        },
        friends(state) {
            return state.friends
        },
        messages(state) {
            return state.messages
        },
        where(state) {
            return state.where
        },
        query(state) {
            return state.query
        },
        travel(state) {
            return state.travel
        },
        filtersTravel(state) {
            return state.filtersTravel
        },
        messagesBetween(state) {
            return state.messagesBetween
        },
        usersMessages(state) {
            return state.usersMessages
        },
        travelId(state) {
            return state.travelId
        },
        travelAddressIds(state) {
            return state.travelAddressIds
        },
        perPage(state) {
            return state.perPage
        },
        popularTravels(state) {
            return state.popularTravels
        },
        nearTravels(state) {
            return state.nearTravels
        },
        lat(state) {
            return state.lat
        },
        lng(state) {
            return state.lng
        },
        getCountries(state) {
            return state.optionsCountries
        },
    },
    actions: {
        /*   onFetchTodos: async ({ commit }) => {
               const response = await Axios.get(
                   "https://jsonplaceholder.typicode.com/todos"
               );
               commit(ACTION_TYPES.fetchTodos, response.data);
           },
           onAddTodo: async ({ commit }, title) => {
               const response = await Axios.post(
                   "https://jsonplaceholder.typicode.com/todos",
                   { title, completed: false }
               );
               console.log(response);
               commit(ACTION_TYPES.addTodo, response.data);
           },
           onDeleteTodo: ({ commit }, id) => {
               Axios.delete(`https://jsonplaceholder.typicode.com/todos/${id}`);
               commit(ACTION_TYPES.deleteTodo, id);
           },
           onFilterTodos: async ({ commit }, limit) => {
               const response = await Axios.get(
                   `https://jsonplaceholder.typicode.com/todos?_limit=${limit}`
               );
               commit(ACTION_TYPES.fetchTodos, response.data);
           },
           onUpdateTodo: async ({ commit }, todo) => {
               console.log(todo);
               const response = await Axios.put(
                   `https://jsonplaceholder.typicode.com/todos/${todo.id}`,
                   todo
               );
               commit(ACTION_TYPES.updateTodo, response.data);
           },
       },
       */
        SEARCH_TRAVELS: async ({commit}, data) => {
            const params = {
                query: data.query,
                where: data.where,
                perPage: data.perPage,
            };
            const response = await Axios.get(`/api/search`, {params})
            commit(ACTION_TYPES.SET_TRAVELS, response.data);
        },
        GET_TRAVELS: async ({commit}, data) => {
            const params = {
                'page': data.page,
                'perPage': data.perPage,
                'where': data.where,
                'query': data.query
            };
            const response = await Axios.get('/api/travels', {params})
            commit(ACTION_TYPES.SET_TRAVELS, response.data);
            commit(ACTION_TYPES.SET_MAP_DATA, response.data);
        },
        GET_FILTERS_MAP: async ({commit}, data) => {
            const response = await Axios.get('/api/getFilterForMap')
            commit(ACTION_TYPES.SET_FILTER_FOR_MAP, response.data);
        },
        SEARCH_TRAVELS_ADDRESS: async ({commit}, data) => {
            const params = {
                page: data.page,
                perPage: data.perPage,
                where: data.where,
                query: data.query,
            };
            const response = await Axios.get('/api/searchTravelsForMap', {params})
            commit(ACTION_TYPES.SET_TRAVELS, response.data);
            commit(ACTION_TYPES.SET_MAP_DATA_ADDRESS, response.data);
        },
        SEARCH_EXTENDED_TRAVELS: async ({commit}, data) => {
            const params = {
                query: data.query,
                where: data.where,
                perPage: data.perPage,
            };
            const response = await Axios.get(`/api/searchextended`, {params});
            commit(ACTION_TYPES.SET_TRAVELS, response.data);
        },
        SEARCH_CITIES: async ({commit}, data) => {
            const params = {
                query: data.query,
                countryIds: data.countryIds,
            };
            const response = await Axios.get(`/api/searchCities`, {params})
            commit(ACTION_TYPES.SET_OPTIONS_CITIES, response.data);
        },
        GET_LAST_TRAVELS: async ({commit}, data) => {
            const response = await Axios.get('/api/travelsLast')
            commit(ACTION_TYPES.SET_LAST_TRAVELS, response.data);
        },
        GET_TRAVEL_COMMENTS: async ({commit}, data) => {
            const params = {
                where: data.where,
            };
            const response = await Axios.get('/api/travelComments', {params})
            commit(ACTION_TYPES.SET_COMMENTS, response.data);
        },
        GET_FRIENDS: async ({commit}, data) => {
            const params = {
                page: data.page,
                where: data.where,
            };
            const response = await Axios.get('/api/friends', {params})
            commit(ACTION_TYPES.SET_FRIENDS, response.data);
        },
        GET_MESSAGES: async ({commit}, data) => {
            const params = {
                page: data.page,
                where: data.where,
            };
            const response = await Axios.get('/api/messages', {params})
            commit(ACTION_TYPES.SET_MESSAGES, response.data);
        },
        GET_MESSAGES_BETWEEN: async ({commit}, data) => {
            const params = {
                page: data.page,
            };
            const response = await Axios.get('/api/messages/${data.where[\'id\']}', {params})
            commit(ACTION_TYPES.SET_MESSAGES_BETWEEN, response.data);
        },
        GET_TRAVEL: async ({commit}, data) => {
            const params = {
                id: data.travel_id,
            };
            const response = await Axios.get('/api/travel', {params})
            commit(ACTION_TYPES.SET_TRAVEL, response.data);
        },
        GET_FILTER_TRAVEL: async ({commit}) => {
            const response = await Axios.get('/api/getFiltersTravel')
            commit(ACTION_TYPES.SET_FILTER_TRAVEL, response.data);
        },
        GET_USERS_MESSAGES: async ({commit}, data) => {
            const params = {
                page: data.page,
                where: data.where,
            };
            const response = await Axios.get('/api/messagesUsers/', {params})
            commit(ACTION_TYPES.SET_USERS_MESSAGES, response.data);
        },
        AUTO_SAVE_TRAVEL: async ({commit}, dataTravel) => {
            const response = await Axios.post('/api/travels/save', dataTravel)
            commit(ACTION_TYPES.SET_SUBMITING_FORM, false);
            commit(ACTION_TYPES.SET_TRAVEL_ID, response.data.id);
            commit(ACTION_TYPES.SET_TRAVEL_ADDRESS_IDS, response.data.travelAddressIds);
        },
        GET_POPULAR_TRAVELS: async ({commit}, data) => {
            const response = await Axios.get('/api/travelsPopular')
            commit(ACTION_TYPES.SET_POPULAR_TRAVELS, response.data);

        },
        GET_NEAR_TRAVELS: async ({commit}, data) => {
            const params = {
                travel_id: data.travel_id,
            };
            const response = await Axios.get('/api/travelsNear', {params})
            commit(ACTION_TYPES.SET_NEAR_TRAVELS, response.data);
        },
        GET_COUNTRIES: async ({commit}) => {
            const response = await Axios.get('/location/countriesforsearch')
            commit(ACTION_TYPES.SET_COUNTRIES, response.data);
        },
        DELETE_TRAVEL: async ({commit},url) => {
            const response = await Axios.del(url)
            commit(ACTION_TYPES.REMOVE_TRAVEL, response.id);
        }
    }
});

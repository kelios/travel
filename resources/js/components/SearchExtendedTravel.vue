<template>
    <div class="container">
        <div class="input-group-append mb-4">
            <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                {{ __('main.search') }}
            </button>

        </div>


        <div class="active-pink-3 active-pink-4 mb-4">

            <Multiselect
                v-if="filter_hide['countries']"
                :options="optionsCountries"
                v-model="countries"
                valueProp = "country_id"
                label="local_name"
                track-by="country_id"
                mode="tags"
                :close-on-select="false"
                :searchable="true"
                :placeholder="__('travels.Searchcountries') "

            />
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <Multiselect
                v-model="categories"
                mode="tags"
                :options="filtersTravel.categories"
                :close-on-select="false"
                :searchable="true"
                :create-option="true"
                valueProp = "id"
                track-by="id"
                label="name"
                :tag-placeholder=" __('travels.categories')"
                :placeholder="__('travels.categories') "
            />
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <Multiselect
                v-if="filtersTravel.transports"
                :options="filtersTravel.transports"
                mode="tags"
                :close-on-select="false"
                :searchable="true"
                v-model="transports"
                valueProp = "id"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.transports')"
                :placeholder="__('travels.transports') "
            />

        </div>


        <div class="active-pink-3 active-pink-4 mb-4">
            <Multiselect
                v-if="filtersTravel.complexity"
                :options="filtersTravel.complexity"
                mode="tags"
                :close-on-select="false"
                :searchable="true"
                :create-option="true"
                v-model="complexity"
                valueProp = "id"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.complexity')"
                :placeholder="__('travels.complexity') "
            />

        </div>


        <div class="active-pink-3 active-pink-4 mb-4">
            <Multiselect
                v-if="filtersTravel.companion"
                :options="filtersTravel.companion"
                mode="tags"
                :close-on-select="false"
                :searchable="true"
                :create-option="true"
                v-model="companion"
                valueProp = "id"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.searchcompanion')"
                :placeholder="__('travels.searchcompanion') "
            />
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <Multiselect
                v-if="filtersTravel.overNightStay"
                :options="filtersTravel.overNightStay"
                mode="tags"
                :close-on-select="false"
                :searchable="true"
                :create-option="true"
                v-model="overNightStay"
                valueProp = "id"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.searchoverNightStay')"
                :placeholder="__('travels.searchoverNightStay') "
            />
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <Multiselect
                v-if="filtersTravel.month"
                :options="filtersTravel.month"
                mode="tags"
                :close-on-select="false"
                :searchable="true"
                :create-option="true"
                v-model="month"
                valueProp = "id"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.month')"
                :placeholder="__('travels.month') "
            />
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <input type="text"
                   v-model="year"
                   v-validate="'digits:4'"
                   class="form-control"
                   id="year"
                   name="year"
                   :placeholder="__('travels.year') "
            />

        </div>

        <div class="input-group-append mb-4">
            <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                {{ __('main.search') }}
            </button>

        </div>
    </div>
</template>

<script>

export default {
    name: "SearchExtendedTravel",
};
</script>
<script setup>

import {
    computed,
    watch
} from "vue";
import Multiselect from "@vueform/multiselect";
import {defineRule} from 'vee-validate';
import {digits} from '@vee-validate/rules';
import {useStore} from 'vuex'

defineRule('digits', digits);

const props = defineProps({
    travels: Object,
    where: Object,
    filter_hide: Object,
    query: String,
    countries: Array,
    optionsCountries: Array,
    categories: Array,
    transports: Array,
    month: Array,
    year: Array,
    filtersTravel: Array

});

const store = useStore()

let countries = [];
let categories = [];
let transports = [];
let month = [];
let year = '';
let complexity = [];
let companion = [];
let overNightStay = [];
let query = '';
let filtersTravel = [];

let travels = computed(() => {
    return props.travels;
});

let where = computed(() => {
    return props.where;
});

let filter_hide = computed(() => {
    return props.filter_hide;
});
/*
let filtersTravel = computed(() => {
    console.log('filtersTravel');
    console.log(filtersTravel);
    return store.getters.filtersTravel;
});
*/

filtersTravel = computed({
    get: () => store.getters.filtersTravel,
})
let perPage = computed({
    get: () => store.getters.perPage,
})

const optionsCountries = computed({
    get: () => store.getters.getCountries,
})

fetchData();

watch(query, (value, oldValue, onCleanup) => {
    console.log(query);
    if (value != oldValue) {
        setTimeout(() => {
            searchTravels()
        }, 100);
    }
})

function fetchData() {
    store.dispatch("GET_COUNTRIES")
    store.dispatch("GET_FILTER_TRAVEL")
}

function searchTravels() {
    let search = where.value
    console.log('searchTravels');
    search['countries'] = countries;
    search['categories'] = categories;
    search['transports'] = transports;
    search['month'] = month;
    search['complexity'] = complexity;
    search['companion'] = companion;
    search['overNightStay'] = overNightStay;

    search['year'] = year;
    store.commit('SET_WHERE', search);
    store.dispatch("SEARCH_EXTENDED_TRAVELS", {
        'query': query.value,
        'perPage': perPage.value,
        'where': search
    })
}
</script>

<style lang="scss" scoped>
@import "@vueform/multiselect/themes/default.scss";
</style>

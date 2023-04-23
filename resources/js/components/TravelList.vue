<template>
    <div class="container">
        <div class="row pb-2" v-if="groupedTravels.length">
            <div class="col-2">
                <SelectPerPage @getRes="getResults"></SelectPerPage>
            </div>
            <div class="col-10">
                <TailwindPagination :data="travels" :limit="5" size="small"
                                    @pagination-change-page="getResults"></TailwindPagination>
            </div>

        </div>

        <div class="row" v-for="travelsEvent in groupedTravels">
            <div class="col-md-6 col-sm-6" v-for="travel in travelsEvent">
                <TravelCard class="animated fadeIn"
                            :readonly="readonly"
                            :travel="travel"
                            @remove="removeFromList">

                </TravelCard>
            </div>
            <div class="col w-100"></div>
        </div>
        <div class="row pb-2" v-if="groupedTravels.length">
            <div class="col-2">
                <SelectPerPage @getRes="getResults"></SelectPerPage>
            </div>
            <div class="col-10">
                <TailwindPagination :data="travels" :limit="6" size="small"
                                    @pagination-change-page="getResults"></TailwindPagination>

            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "TravelList",
};
</script>
<script setup>

import SelectPerPage from '../components/SelectPerPage'
import TravelCard from '../components/TravelCard'
import {TailwindPagination} from 'laravel-vue-pagination';
import {ref, computed} from "vue";
import {useStore} from 'vuex'
import _ from 'lodash';

const props = defineProps({
    readonly: Boolean,
    filter: Object,
    travels: Object,
    where: Object,
    query: Object,
    groupedTravels: Array,
});


const store = useStore()

let perPage = computed(() => {
    return store.getters.perPage;
});

const readonly = computed(() => {
    return props.readonly;
});

const filter = computed(() => {
    return props.filter;
});

let travels = computed({
    get: () => store.getters.travels,
});

let where = computed({
    get: () => store.getters.where,
});

let query = computed({
    get: () => store.getters.query,
});

let groupedTravels = computed(() => {
    return _.chunk(store.getters.travels?.data, 6);
});


getResults();

function removeFromList(id) {
    travels.data = travels.data.filter(travel => travel.id !== id)
}

function getResults(page = 1) {
    store.dispatch('GET_TRAVELS', {
        'page': page,
        'query': query.value,
        'where': Object.assign(filter.value, where),
        'perPage': perPage.value
    });
}

</script>

<style scoped>

</style>

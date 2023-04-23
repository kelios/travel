<template>
    <div class="row">
        <div class="col-lg-4" v-for="travelsEvent in lastTravels">
            <travel-card-last :travel="travelsEvent"></travel-card-last>
        </div>
    </div>
</template>

<script>

export default {
    name: "TravelLast",
};
</script>
<script setup>
import _ from 'lodash';
import TravelCardLast from './TravelCardLast.vue';
import {useStore} from 'vuex'
import {computed} from "vue";

const store = useStore()
let groupedTravels = computed(() => {
    return _.chunk(travels.lastTravels, 15);
});
let lastTravels = computed(() => {
    return store.getters.lastTravels;
});

getResults()

function getResults() {
    store.dispatch('GET_LAST_TRAVELS');
}

</script>

<style scoped>

</style>

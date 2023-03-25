<template>

    <div class="row" v-if="nearTravels.length">
        <h1>{{__('travels.nearTravels')}}</h1>
        <div class="col-lg-4" v-for="travelsEvent in nearTravels">
            <travel-card-last :travel="travelsEvent"></travel-card-last>
        </div>
    </div>
</template>

<script>
    import TravelCardLast from '../components/TravelCardLast.vue'
    import _ from 'lodash';
    import {mapGetters} from 'vuex'

    export default {
        name: 'TravelNear',
        components: {
            'travel-card-last': TravelCardLast
        },
        mounted() {
            this.getResults();

        },
        computed: {
            groupedTravels() {
                return _.chunk(this.nearTravels, 15);
            },
            ...mapGetters([
                'nearTravels'
            ])
        },
        methods: {
            getResults() {
                this.$store.dispatch('GET_NEAR_TRAVELS', {'travel_id': this.$parent.travel_id});
            }
        },
    }
</script>

<style scoped>

</style>

<template>
    <div class="row">
        <div class="col-lg-4" v-for="travelsEvent in popularTravels">
            <travel-card-last :travel="travelsEvent"></travel-card-last>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import TravelCardLast from '../components/TravelCardLast.vue'
    import {mapGetters} from 'vuex'


    export default {
        name: 'TravelPopular',
        components: {
            TravelCardLast
        },
        mounted() {
            this.getResults();
        },
        computed: {
            groupedTravels() {
                return _.chunk(this.popularTravels, 15);
            },
            ...mapGetters([
                'popularTravels'
            ])
        },
        methods: {
            getResults() {
                this.$store.dispatch('GET_POPULAR_TRAVELS');
            }
        },
    }
</script>

<style scoped>

</style>

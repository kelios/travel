<template>
    <div class="row">
        <div class="col-lg-4" v-for="travelsEvent in lastTravels">
            <travel-card-last :travel="travelsEvent"></travel-card-last>
        </div>
    </div>
</template>

<script>
    import TravelCardLast from '../components/TravelCardLast';

    import {mapGetters} from 'vuex'

    export default {
        name: 'TravelLast',
        components: {
            TravelCardLast
        },
        mounted() {
            this.getResults();

        },
        computed: {
            groupedTravels() {
                return _.chunk(this.lastTravels, 15);
            },
            ...mapGetters([
                'lastTravels'
            ])
        },
        methods: {
            getResults() {
                this.$store.dispatch('GET_LAST_TRAVELS');
            }
        },
    }
</script>

<style scoped>

</style>

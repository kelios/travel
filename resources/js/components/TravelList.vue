<template>
    <div class="container">
        <div class="row" v-for="travelsEvent in groupedTravels">
            <div class="col-md-6 col-sm-6" v-for="travel in travelsEvent">
                <travel-card class="animated fadeIn" :readonly="readonly" :travel="travel"
                             @remove="removeFromList"></travel-card>
            </div>
            <div class="col w-100"></div>
        </div>
        <pagination :data="travels" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    import travel from '../components/TravelCard'
    import {mapGetters} from 'vuex'
    import pagination from 'laravel-vue-pagination'

    export default {
        name: 'TravelList',
        props: ['readonly'],
        components: {
            travel,
            pagination
        },
        mounted() {
            this.getResults();
            window.Echo.channel('search')
                .listen('.searchResults', (e) => {
                    this.$store.commit('SET_TRAVELS', e.travels)
                })
        },
        computed: {
            groupedTravels() {
                return _.chunk(this.travels.data, 15);
            },
            ...mapGetters([
                'travels'
            ])
        },
        methods: {
            removeFromList(id) {
                this.travels.data = this.travels.data.filter(travel => travel.id !== id)
            },
            getResults(page = 1) {
                this.$store.dispatch('GET_TRAVELS', {page});
            }
        },
    }
</script>

<style scoped>

</style>

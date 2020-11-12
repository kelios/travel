<template>
    <div class="container">
        <pagination :data="travels" :limit="5" align="center" size="small"
                    @pagination-change-page="getResults"></pagination>
        <div class="row" v-for="travelsEvent in groupedTravels">
            <div class="col-md-6 col-sm-6" v-for="travel in travelsEvent">
                <travel-card class="animated fadeIn" :readonly="readonly" :travel="travel"
                             @remove="removeFromList"></travel-card>
            </div>
            <div class="col w-100"></div>
        </div>
        <pagination :data="travels" :limit="6" align="center" size="small"
                    @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    import travel from '../components/TravelCard'
    import {mapGetters} from 'vuex'
    import pagination from 'laravel-vue-pagination'

    export default {
        name: 'TravelList',
        props: ['readonly','filter'],
        components: {
            travel,
            pagination
        },
        mounted() {
            this.getResults();
            window.Echo.channel('search')
                .listen('.searchResults', (e) => {
                    this.$store.commit('SET_TRAVELS', e.travels);
                    this.$store.commit('SET_WHERE', e.where)
                })
        },
        computed: {
            groupedTravels() {
                return _.chunk(this.travels.data, 6);
            },
            ...mapGetters([
                'travels',
                'where',
                'query'
            ])
        },
        methods: {
            removeFromList(id) {
                this.travels.data = this.travels.data.filter(travel => travel.id !== id)
            },
            getResults(page = 1) {
                console.log('filter');
                console.log(this.filter);
                console.log('where');
                console.log(this.where);
                console.log('query');
                console.log(this.query);
                this.$store.dispatch('GET_TRAVELS', {'page': page, 'query':this.query, 'where': Object.assign(this.filter,this.where)});
            }
        },
    }
</script>

<style scoped>

</style>

<template>
    <div class="container">
        <div class="row pb-2" v-if="groupedTravels.length">
            <div class="col-2">
                <select-per-page @getRes="getResults"></select-per-page>
            </div>
            <div class="col-10">
                <TailwindPagination :data="travels" :limit="5" size="small"
                            @pagination-change-page="getResults"></TailwindPagination>
            </div>

        </div>

        <div class="row" v-for="travelsEvent in groupedTravels">
            <div class="col-md-6 col-sm-6" v-for="travel in travelsEvent">
                <travel-card class="animated fadeIn" :readonly="readonly" :travel="travel"
                             @remove="removeFromList"></travel-card>
            </div>
            <div class="col w-100"></div>
        </div>
        <div class="row pb-2" v-if="groupedTravels.length">
            <div class="col-2">
                <select-per-page @getRes="getResults"></select-per-page>
            </div>
            <div class="col-10">
                <TailwindPagination :data="travels" :limit="6" size="small"
                            @pagination-change-page="getResults"></TailwindPagination>

            </div>
        </div>
    </div>
</template>

<script>
    import SelectPerPage from './SelectPerPage.vue'
    import TravelCard from './TravelCard.vue'
    import {mapGetters} from 'vuex'
    import { TailwindPagination } from 'laravel-vue-pagination';


    export default {
        name: 'TravelList',
        props: ['readonly', 'filter'],
        components: {
            TravelCard,
            TailwindPagination,
            'select-per-page': SelectPerPage,
        },
        mounted() {
            console.log('123');
            this.getResults();
        },
        computed: {
            groupedTravels() {
                return _.chunk(this.travels.data, 6);
            },
            ...mapGetters([
                'travels',
                'where',
                'query',
                'perPage',
            ])
        },
        methods: {
            removeFromList(id) {
                this.travels.data = this.travels.data.filter(travel => travel.id !== id)
            },
            getResults(page = 1) {
              //  console.log(this.filter);
               // console.log(this.where);
                this.$store.dispatch('GET_TRAVELS', {
                    'page': page,
                    'query': this.query,
                    'where': this.filter,
                    'perPage': this.perPage
                });
            }
        },
    }
</script>


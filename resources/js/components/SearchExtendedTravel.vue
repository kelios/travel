<template>
    <div class="container">
        <div class="input-group-append mb-4">
            <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                {{__('main.search')}}
            </button>

        </div>
        <div class="active-pink-3 active-pink-4 mb-4">

            <multiselect
                v-if="filter_hide['countries']"
                :options="optionsCountries"
                :multiple="true"
                v-model="countries"
                track-by="country_id"
                label="local_name"
                :tag-placeholder=" __('travels.countries')"
                :placeholder="__('travels.Searchcountries') "
                selectLabel=""
            >
            </multiselect>
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <multiselect
                v-if="filtersTravel.categories"
                :options="filtersTravel.categories"
                :multiple="true"
                v-model="categories"
                track-by="id"
                label="name"
                :tag-placeholder=" __('travels.categories')"
                :placeholder="__('travels.categories') "
                selectLabel=""
            >
            </multiselect>
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <multiselect
                v-if="filtersTravel.transports"
                :options="filtersTravel.transports"
                :multiple="true"
                v-model="transports"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.transports')"
                :placeholder="__('travels.transports') "
            >
            </multiselect>
        </div>


        <div class="active-pink-3 active-pink-4 mb-4">
            <multiselect
                v-if="filtersTravel.complexity"
                :options="filtersTravel.complexity"
                :multiple="true"
                v-model="complexity"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.complexity')"
                :placeholder="__('travels.complexity') "
            >
            </multiselect>
        </div>


        <div class="active-pink-3 active-pink-4 mb-4">
            <multiselect
                v-if="filtersTravel.companion"
                :options="filtersTravel.companion"
                :multiple="true"
                v-model="companion"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.searchcompanion')"
                :placeholder="__('travels.searchcompanion') "
            >
            </multiselect>
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <multiselect
                v-if="filtersTravel.overNightStay"
                :options="filtersTravel.overNightStay"
                :multiple="true"
                v-model="overNightStay"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.searchoverNightStay')"
                :placeholder="__('travels.searchoverNightStay') "
            >
            </multiselect>
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <multiselect
                v-if="filtersTravel.month"
                :options="filtersTravel.month"
                :multiple="true"
                v-model="month"
                track-by="id"
                label="name"
                selectLabel=""
                :tag-placeholder=" __('travels.month')"
                :placeholder="__('travels.month') "
            >
            </multiselect>
        </div>

        <div class="active-pink-3 active-pink-4 mb-4">
            <input type="text"
                   v-model="year"
                   v-validate="'integer'"
                   @input="validate($event)"
                   class="form-control"
                   id="year"
                   name="year"
                   :placeholder="__('travels.year') "
            >
        </div>

        <div class="input-group-append mb-4">
            <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                {{__('main.search')}}
            </button>

        </div>
    </div>
</template>

<script>
    import 'vue-multiselect/dist/vue-multiselect.min.css';
    import Multiselect from 'vue-multiselect'

    import {mapGetters} from "vuex";

    export default {
        name: "SearchExtendedTravel",
        props: ['travels', 'where', 'filter_hide'],
        components: {
            Multiselect
        },
        data: function () {
            return {
                countries: [],
                optionsCountries: [],
                categories: [],
                transports: [],
                month: [],
                year: '',
                complexity: [],
                companion: [],
                overNightStay: []
            }
        },
        watch: {
            query: {
                handler: _.debounce(function () {
                    this.searchTravels()
                }, 100)
            }
        },
        mounted() {
            this.getCountries();
            this.fetchFilters();
       /*     window.Echo.channel('searchCity')
                .listen('.searchResultsCity', (e) => {
                    this.optionsCities = e.cities;
                })*/
        },
        computed: {
            ...mapGetters([
                'filtersTravel',
                'perPage',
                'optionsCities',
            ])
        },

        methods: {
            async getCountries() {
                let vm = this;
                axios.get('/location/countriesforsearch')
                    .then(function (response) {
                        vm.optionsCountries = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            fetchFilters() {
                this.$store.dispatch('GET_FILTER_TRAVEL');
            },
            searchTravels() {
                this.where['countries'] = this.countries.map(function (value) {
                    return value.country_id
                });

                this.where['categories'] = this.categories.map(function (value) {
                    return value.id
                });

                this.where['transports'] = this.transports.map(function (value) {
                    return value.id
                });

                this.where['month'] = this.month.map(function (value) {
                    return value.id
                });

                this.where['complexity'] = this.complexity.map(function (value) {
                    return value.id
                });

                this.where['companion'] = this.companion.map(function (value) {
                    return value.id
                });

                this.where['overNightStay'] = this.overNightStay.map(function (value) {
                    return value.id
                });


                this.where['year'] = this.year;

                this.$store.dispatch('SEARCH_EXTENDED_TRAVELS', {
                    'query': this.query,
                    'perPage': this.perPage, 'where': this.where
                })
            }
        }

    }
</script>

<style scoped>

</style>

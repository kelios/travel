<template>
    <div class="container p-3">

        <div class="row">

            <div class="col-md-3">
                <div class="card-header titleindex">
                    <h1>{{translate('main.mapTravel')}}</h1>
                </div>
            </div>

            <div class="col-md-3 p-3">
                <label>{{translate('travels.traveladdresscategory')}}</label>
                <multiselect
                    v-if="filtersTravel.categories"
                    :options="filtersTravel.categories"
                    :multiple="true"
                    v-model="categories"
                    track-by="id"
                    label="name"
                    :tag-placeholder=" translate('travels.traveladdresscategory')"
                    :placeholder="translate('travels.traveladdresscategory') "
                    selectLabel=""
                >
                </multiselect>
            </div>

            <div class="col-md-3 p-3">
                <label>{{translate('travels.searchRadius')}}</label>
                <multiselect
                    v-if="filtersTravel.radius"
                    :options="filtersTravel.radius"
                    :multiple="false"
                    v-model="radius"
                    track-by="id"
                    label="name"
                    :tag-placeholder=" translate('travels.searchRadius')"
                    :placeholder="translate('travels.searchRadius') "
                    selectLabel=""
                >
                </multiselect>
            </div>

            <div class="col-md-3 p-3">
                <label>{{translate('travels.searchAddress')}}</label>
                <input v-model="address"
                       type="text"
                       class="form-control"
                       :placeholder="translate('travels.searchAddress')"
                       aria-label="translate('travels.searchAddress')"
                       aria-describedby="basic-addon2">
            </div>

        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import 'vue-multiselect/dist/vue-multiselect.min.css';
    import Multiselect from 'vue-multiselect'

    export default {
        name: "FilterMap",
        data: function () {
            return {
                address: '',
                radius: {'id':60,'name':60},
                categories: [],
                where: {},
            }
        },
        components: {Multiselect},
        computed: {
            ...mapGetters([
                'perPage',
                'filtersTravel',
                'lat',
                'lng'
            ])
        },
        mounted() {
            this.getFilters();
        },
        watch: {
            radius: {
                handler: _.debounce(function () {
                    this.getResults()
                }, 100)
            },
            categories: {
                handler: _.debounce(function () {
                    this.getResults()
                }, 100)
            },
            address: {
                handler: _.debounce(function () {
                    this.getResults()
                }, 100)
            }
        },
        methods: {
            getResults(page = 1) {
                this.where.lat = this.lat;
                this.where.lng = this.lng;
                this.where.radius = this.radius;
                this.where.address = this.address;
                this.where.categories = this.categories;
                this.$store.dispatch('SEARCH_TRAVELS_ADDRESS', {'page': page, 'where': this.where})

            },
            getFilters(page = 1) {
                this.$store.dispatch('GET_FILTERS_MAP')

            },
            searchTravels() {
                this.$store.commit('SET_QUERY', this.query)
                this.$store.dispatch('SEARCH_TRAVELS', {
                    'query': this.query,
                    'perPage': this.perPage,
                    'where': this.where
                })
            }
        }

    }
</script>

<style scoped>

</style>

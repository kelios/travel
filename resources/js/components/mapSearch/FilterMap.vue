<template>
    <div class="container p-3">

        <div class="row">

            <div class="col-md-3">
                <div class="card-header titleindex">
                    <h1>{{__('main.mapTravel')}}</h1>
                </div>
            </div>

            <div class="col-md-3 p-3">
                <label>{{__('travels.traveladdresscategory')}}</label>
                <multiselect
                    v-if="filtersTravel.categories"
                    :options="filtersTravel.categories"
                    :multiple="true"
                    v-model="categories"
                    track-by="id"
                    label="name"
                    :tag-placeholder="__('travels.traveladdresscategory')"
                    :placeholder="__('travels.traveladdresscategory') "
                    selectLabel=""
                >
                </multiselect>
            </div>

            <div class="col-md-3 p-3">
                <label>{{__('travels.searchRadius')}}</label>
                <multiselect
                    v-if="filtersTravel.radius"
                    :options="filtersTravel.radius"
                    :multiple="false"
                    v-model="radius"
                    track-by="id"
                    label="name"
                    :tag-placeholder=" __('travels.searchRadius')"
                    :placeholder="__('travels.searchRadius') "
                    selectLabel=""
                >
                </multiselect>
            </div>

            <div class="col-md-3 p-3">
                <label>{{__('travels.searchAddress')}}</label>
                <input v-model="address"
                       type="text"
                       class="form-control"
                       :placeholder="__('travels.searchAddress')"
                       aria-label="__('travels.searchAddress')"
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
            radius(newVal) {
                    this.radius=newVal;
                    this.getResults();
            },
            categories(newVal) {
                    this.categories=newVal;
                    this.getResults();
               },
            address(newVal) {
                    this.address=newVal;
                    this.getResults();
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

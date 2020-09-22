<template>
    <div class="container">
        <div class="ctive-pink-3 active-pink-4 mb-4">

            <multiselect
                :options="optionsCountries"
                :multiple="true"
                v-model="countries"
                track-by="country_id"
                label="local_name"
                :tag-placeholder=" translate('travels.countries')"
                :placeholder="translate('travels.Search countries') ">
            </multiselect>
        </div>
            <div class="input-group-append mb-4">
                <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                    {{translate('main.search')}}
                </button>

        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchExtendedTravel",
        props: ['travels', 'where'],
        data: function () {
            return {
                countries: [],
                optionsCountries: []
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
            window.Echo.channel('searchCity')
                .listen('.searchResultsCity', (e) => {
                    this.optionsCities = e.cities;
                })
        },
        methods: {
            getCountries() {
                let vm = this;
                axios.get('/location/countries')
                    .then(function (response) {
                        vm.optionsCountries = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            searchTravels() {
                this.where['countries'] = this.countries.map(function (value) {
                    return value.country_id
                });
                this.$store.dispatch('SEARCH_EXTENDED_TRAVELS', {'query': this.query, 'where': this.where})
            }
        }

    }
</script>

<style scoped>

</style>

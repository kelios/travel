<template>
    <div class="container">
        <div class="input-group mb-3">

            <multiselect
                :options="optionsCountries"
                :multiple="true"
                v-model="countries"
                track-by="country_id"
                label="local_name"
                :tag-placeholder=" __('travels.countries')"
                :placeholder="__('travels.Select countries') ">
            </multiselect>

            <div class="input-group-append">
                <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                    {{__('main.search')}}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchExtendedTravel",
        props: ['travels', 'where'],
        data: function () {
            return {
                query: '',
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
                console.log('this.countries');
                console.log(this.countries);
                console.log('this.where');
                this.where['countries'] = this.countries.filter(
                    function (country) {
                        return country.country_id
                    }
                );
                console.log(this.where);
                this.$store.dispatch('SEARCH_TRAVELS', {'query': this.query, 'where': this.where})
            }
        }

    }
</script>

<style scoped>

</style>

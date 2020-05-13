import AppForm from '../app-components/Form/AppForm';
import config from "../../config";
import {yandexMap, ymapMarker} from 'vue-yandex-maps';

Vue.component('travel-form', {
    mixins: [AppForm],
    data: function () {
        return {

            form: {
                name: '',
                categories: '',
                transports: '',
                month: '',
                complexity: '',
                overNightStay: '',
                cities: [],
                optionsCities: [],
                countries: [],
                optionsCountries: [],
                budget: '',
                year: '',
                number_peoples: '',
                number_days: '',
                minus: '',
                plus: '',
                recommendation: '',
                description: '',
                publish: false,
                visa: false,

                selectedCountriesCode: [],
                selectedCountiesIds: [],
                selectedAddress: [],

                mapCoords: [
                    53.8828449,
                    27.7273595
                ],
                coords: [],
                bounds: [],
                address: [],
            }
        }
    },
    computed: {
        mapSettings() {
            return config.map;
        },
    },
    methods: {
        mapInit() {
        },
        getCountries: function () {
            axios.get('/location/countries')
                .then(function (response) {
                    this.form.optionsCountries = response.data;
                }.bind(this));

        },
        getCitiesSelected: function (items) {
            items.forEach((item) => {
                this.form.selectedCountiesIds.push(item.id);
                this.form.selectedCountriesCode.push(item.code.toUpperCase());
            });
            this.getCities();
        },
        getCities: function () {
            let self = this;
            if (this.form.selectedCountiesIds.length > 0) {
                axios.get('/location/countriesCities', {
                    params: {
                        country_id: this.form.selectedCountiesIds
                    }
                }).then(function (response) {
                    this.form.optionsCities = response.data;
                    console.log(this.form.cities);
                }.bind(this));
            } else {
                this.form.optionsCities = [];
                this.form.cities = [];
                this.form.coords = [];
            }
        },
        onClick(e) {
            let coords = e.get('coords');
            this.form.coords.push(coords);
            this.form.mapCoords = coords;
            this.getAddress(coords);
            this.$emit('coordinates-changed', {
                coords: this.form.coords,
                address: this.form.address,
            });
        }
        ,
        setMarker: function (items) {
            let selectedCities = [];
            let data = [];
            items.forEach((item) => {
                selectedCities.push(item.name);
                ymaps.geocode(item.name, {results: 1}).then(res => {
                    const firstGeoObject = res.geoObjects.get(0),
                        // Координаты геообъекта.
                        coords = firstGeoObject.geometry.getCoordinates(),
                        // Область видимости геообъекта.
                        bounds = firstGeoObject.properties.get('boundedBy');

                    this.form.coords.push(coords);
                    this.form.mapCoords = coords;
                    this.$emit('coordinates-changed', {
                        coords: this.form.coords,
                        address: this.form.address,
                    });
                    this.$refs.map.setBounds(bounds, {
                        checkZoomRange: true
                    });
                });
            });
        }
        ,
// Определяем адрес по координатам (обратное геокодирование).
        getAddress: function (coords) {
            let vm = this;
            ymaps.geocode(coords).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);
                /* console.log(firstGeoObject.getLocalities());
                 console.log(firstGeoObject.getAddressLine());
                 console.log(firstGeoObject.getAdministrativeAreas());
                 console.log(firstGeoObject.getCountry());
                 console.log(firstGeoObject.getCountryCode());
                 console.log(self);*/

                vm.form.selectedAddress.push(firstGeoObject.getAddressLine());

                if (!vm.form.selectedCountriesCode.includes(firstGeoObject.getCountryCode())) {
                    vm.form.optionsCountries.forEach(function (item, index, array) {
                        if (item['code'].toUpperCase() == firstGeoObject.getCountryCode()) {
                            vm.form.countries.push(vm.form.optionsCountries[index]);
                            vm.form.selectedCountiesIds.push(item['id']);
                            vm.form.selectedCountriesCode.push(item['code'].toUpperCase());
                            vm.getCities();
                        }
                    });
                }
            });
        },
        toggleUnSelectMarketCounty: function (item) {
            this.form.selectedCountiesIds = this.form.selectedCountiesIds.filter(function (value, index, arr) {
                return value != item.id;
            });

            this.form.selectedCountriesCode = this.form.selectedCountriesCode.filter(function (value, index, arr) {
                return value != item.code.toUpperCase();
            });
            this.form.cities = this.form.cities.filter(function (value, index, arr) {
                return value.country_id != item.id;
            });
            this.getCities();
        },

    },
    created: function () {
        this.getCountries();
    }
    ,
    components: {
        yandexMap, ymapMarker
    }
})
;

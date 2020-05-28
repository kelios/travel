import AppForm from '../app-components/Form/AppForm';
import L from "leaflet";
import {LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon} from "vue2-leaflet";

const ENDPOINTREVERSE = 'https://nominatim.openstreetmap.org/reverse';
const ENDPOINTSEARCH = 'https://nominatim.openstreetmap.org/search?';
const FORMAT = 'jsonv2';

Vue.component('travel-form', {
    mixins: [AppForm],
    mounted() {
        this.init();
        this.getCountries();
        if (this.form.countryIds.length > 0) {
            this.getCities();
        }
        console.log(this.form);
    },

    data: function () {
        return {
            mediaCollections: ['travelMainImage'],
            optionsCountries: [],
            optionsCities: [],
            travelAddress: {
                'address': [],
                'meCoord': [],
                'city': [],
                'country': []
            },

            coords: [],
            zoom: 9,
            center: L.latLng(53.8828449, 27.7273595),
            url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            staticAnchor: [16, 37],
            isLoading: false,
            selectedCountriesCode: [],
            selectedCountiesIds: [],
            form: {
                name: '',
                categories: [],
                transports: [],
                month: [],
                complexity: [],
                over_night_stay: [],
                cities: [],
                countries: [],
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
                coordsMeTravel: [],
                countryIds: [],
                travelAddressCity: [],
                travelAddressCountry: [],
                travelAddressAdress: [],
            }
        }
    },
    methods: {
        init: function () {
            this.travelAddress.address = this.form.travelAddressAdress;
            this.travelAddress.meCoord = this.form.coordsMeTravel;
            this.travelAddress.city = this.form.travelAddressCity;
            this.travelAddress.country = this.form.travelAddressCountry;
            this.selectedCountiesIds = this.form.countryIds;
          //  this.coords = this.form.coordsMeTravel;
        },
        async getCountries() {
            let vm = this;
            axios.get('/location/countries')
                .then(function (response) {
                    vm.optionsCountries = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        getCitiesSelected: function (items) {
            items.forEach((item) => {
                this.selectedCountiesIds.push(item.country_id);
                this.selectedCountriesCode.push(item.country_code);

            });
            if (items.length > 1) {
                this.gecodingAddress({country: items[items.length - 1].local_name}, false, true);
            }
            this.getCities();
        },
        getCities: function () {
            let self = this;
            if (this.selectedCountiesIds.length > 0) {
                axios.get('/location/countriesCities', {
                    params: {
                        country_id: this.selectedCountiesIds
                    }
                }).then(function (response) {
                    this.optionsCities = response.data;
                }.bind(this));
            } else {
                this.optionsCities = [];
                this.form.cities = [];
              //  this.form.coordsMeTravel = [];
            }
        },
        onClick(e) {
            let coordOnClick = e.latlng;
            this.travelAddress.meCoord.push(coordOnClick);
            this.getAddress(coordOnClick);
        },
        setMarkerCity: function (item) {
            this.travelAddress.address.push(item.local_name);
            this.travelAddress.country.push(item.country_id);
            this.travelAddress.city.push(item.id);
            this.gecodingAddress({q: item.local_name + ',' + item.country_title_en}, true, true);
        },
        removeCity: function (item) {
            let indexCity = this.travelAddress.address.findIndex(function (value, index, arr) {
                return value == item.local_name;
            });
            let latlng = this.travelAddress.meCoord[indexCity];
            this.$delete(this.travelAddress.meCoord, indexCity);
            this.$delete(this.travelAddress.address, indexCity);
            this.$delete(this.travelAddress.country, indexCity);
            this.$delete(this.travelAddress.city, indexCity);
        },
        gecodingAddress: function (param, setMarker = false, setZoom = true) {
            param.format = FORMAT;
            let vm = this;
            axios.get(ENDPOINTSEARCH, {
                params: param,
            }).then(function (response) {
                if (response.data[0]) {
                    let latlng = {};
                    latlng.lat = response.data[0].lat;
                    latlng.lng = response.data[0].lon;

                    if (setMarker) {
                        vm.travelAddress.meCoord.push(latlng);
                    }
                    if (setZoom) {
                        vm.center = latlng;
                        vm.zoomUpdate(4);
                    }
                }

            });
        },
        currentCoordinates: function () {
            return new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(
                    ({coords}) => resolve(coords),
                    // Reject if the user doesn't
                    // allow accessing their location.
                    error => reject(error),
                );
            });
        },
// Определяем адрес по координатам (обратное геокодирование).
        getAddress: function (coords) {
            let vm = this;
            axios.get(ENDPOINTREVERSE, {
                params: {
                    format: FORMAT,
                    lat: coords.lat,
                    lon: coords.lng,
                },
            }).then(function (response) {
                vm.travelAddress.address.push(response.data.display_name);
                vm.travelAddress.city.push('-1');
                let country_code = response.data.address.country_code;

                if (!vm.selectedCountriesCode.includes(country_code)) {
                    console.log(country_code);
                    console.log(vm.selectedCountriesCode);
                    vm.optionsCountries.forEach(function (item, index, array) {

                        if (item['country_code'] == country_code) {
                            vm.form.countries.push(item);
                            vm.selectedCountiesIds.push(item['country_id']);
                            vm.selectedCountriesCode.push(item['country_code']);
                            vm.travelAddress.country.push(item['country_id']);
                            vm.getCities();
                        }
                    });
                } else {
                    console.log(country_code);
                    console.log(vm.selectedCountriesCode);
                    vm.optionsCountries.forEach(function (item, index, array) {
                        if (item['country_code'] == country_code) {
                            vm.travelAddress.country.push(item['country_id']);
                        }
                    });
                }
            });
        },
        toggleUnSelectMarketCounty: function (item) {
            this.selectedCountiesIds = this.selectedCountiesIds.filter(function (value, index, arr) {
                return value != item.country_id;
            });

            this.selectedCountriesCode = this.selectedCountriesCode.filter(function (value, index, arr) {
                return value != item.code;
            });
            this.form.cities = this.form.cities.filter(function (value, index, arr) {
                return value.country_id != item.country_id;
            });
            this.getCities();
        },
        removeMarker: function (address, latlng, index) {
            this.form.cities = this.form.cities.filter(function (value, index, arr) {
                return (value.local_name != address);
            });
            this.$delete(this.travelAddress.meCoord, index);
            this.$delete(this.travelAddress.address, index);
            this.$delete(this.travelAddress.city, index);
            this.$delete(this.travelAddress.country, index);
        },
        zoomUpdate(zoom) {
            this.zoom = zoom;
        },
        centerUpdate(center) {
            this.center = center;
        },

    },
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup,
        LTooltip,
        LIcon
    }
});

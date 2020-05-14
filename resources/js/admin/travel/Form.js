import AppForm from '../app-components/Form/AppForm';
import config from "../../config";
import L from "leaflet";
import {LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon} from "vue2-leaflet";

const ENDPOINTREVERSE = 'https://nominatim.openstreetmap.org/reverse';
const ENDPOINTSEARCH = 'https://nominatim.openstreetmap.org/search?';
const FORMAT = 'jsonv2';

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
                selectedAddress: {
                    'address': [],
                    'coords': []
                },

                mapCoords: [
                    53.8828449,
                    27.7273595
                ],
                coords: [],
                bounds: [],
                address: [],


                zoom: 9,
                center: L.latLng(53.8828449, 27.7273595),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                staticAnchor: [16, 37],
            }
        }
    },
    computed: {
        mapSettings() {
            return config.map;
        },
    },

    methods: {
        getCountries: function () {
            axios.get('/location/countries')
                .then(function (response) {
                    this.form.optionsCountries = response.data;
                }.bind(this));

        },
        getCitiesSelected: function (items) {
            items.forEach((item) => {
                this.form.selectedCountiesIds.push(item.id);
                this.form.selectedCountriesCode.push(item.code);

            });
            this.gecodingAddress({country: items[items.length-1].name}, false, true);
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
                }.bind(this));
            } else {
                this.form.optionsCities = [];
                this.form.cities = [];
                this.form.coords = [];
            }
        },
        onClick(e) {
            let coords = e.latlng;
            this.form.coords.push(coords);
            this.getAddress(coords);
        },
        setMarker: function (items) {
            let selectedCities = [];
            items.forEach((item) => {
                selectedCities.push(item.name);
                this.gecodingAddress({city: item.name,country:item.country.name}, true, true);
            });
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
                        vm.form.coords.push(latlng);
                    }
                    if (setZoom) {
                        vm.form.center = latlng;
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
                vm.form.selectedAddress.address.push(response.data.display_name);
                vm.form.selectedAddress.coords.push(coords);

                let country_code = response.data.address.country_code;

                if (!vm.form.selectedCountriesCode.includes(country_code)) {
                    vm.form.optionsCountries.forEach(function (item, index, array) {
                        if (item['code'] == country_code) {
                            vm.form.selectedCountiesIds.push(item['id']);
                            vm.form.selectedCountriesCode.push(item['code']);
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
                return value != item.code;
            });
            this.form.cities = this.form.cities.filter(function (value, index, arr) {
                return value.country_id != item.id;
            });
            this.getCities();
        },
        removeMarker: function (latlng, index) {
            this.$delete(this.form.selectedAddress.coords, index);
            this.$delete(this.form.selectedAddress.address, index);
            this.form.coords = this.form.coords.filter(function (value, index, arr) {
                return (value[0] != latlng[0] && value[1] != latlng[1]);
            });
        },
        zoomUpdate(zoom) {
            this.form.currentZoom = zoom;
        },
        centerUpdate(center) {
            this.form.currentCenter = center;
        },

    },
    created: function () {
        this.getCountries();
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

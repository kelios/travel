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
                mapCoords: [
                    53.8828449,
                    27.7273595
                ],
                coords: [],
                bounds: [],
                address: '',
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
        getCities: function (items) {
            let selectedCounties = [];
            items.forEach((item) => {
                selectedCounties.push(item.id);
            });
            axios.get('/location/countriesCities', {
                params: {
                    country_id: selectedCounties
                }
            }).then(function (response) {
                this.form.optionsCities = response.data;
                var cities = response.data;
            }.bind(this));
        },
        onClick(e) {
            this.form.coords = e.get('form.coords');
        },
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
        },
    },
    created: function () {
        this.getCountries();
    },
    components: {
        yandexMap, ymapMarker
    }
});

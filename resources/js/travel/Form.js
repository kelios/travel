import AppForm from '../app-components/Form/AppForm';
import VeeValidate from 'vee-validate';
import L from "leaflet";
import 'leaflet/dist/leaflet.css';
import {ToggleButton} from 'vue-js-toggle-button'
import {LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon} from "vue2-leaflet";
import {mapGetters} from "vuex";

import 'vue-multiselect/dist/vue-multiselect.min.css';
import Multiselect from 'vue-multiselect';

const ENDPOINTREVERSE = 'https://nominatim.openstreetmap.org/reverse';
const ENDPOINTSEARCH = 'https://nominatim.openstreetmap.org/search?';
const FORMAT = 'jsonv2';

Vue.use(VeeValidate, {strict: true})

Vue.component('travel-form', {
    mixins: [AppForm],

    mounted() {
        this.init();
        this.getCountries();
        this.getUsers();
        this.autoSave();
        window.Echo.channel('searchCity')
            .listen('.searchResultsCity', (e) => {
                this.optionsCities = e.cities;
            })
    },
    computed: {
        ...mapGetters([
            'travelId',
            'travelAddressIds',
            'submitingForm'
        ]),
    },

    data: function () {
        return {
            mediaCollections: ['travelMainImage', 'gallery', 'travelRoad', 'travelImageAddress'],
            optionsCountries: [],
            optionsUsers: [],
            optionsCities: [],
            travelAddress: {
                'id': [],
                'address': [],
                'meCoord': [],
                'city': [],
                'country': [],
                'travelImageThumbUrl': [],
                'thumbs200Collection': [],
            },
            where: [],
            query: '',
            coords: [],
            zoom: 9,
            center: L.latLng(53.8828449, 27.7273595),
            url: 'https://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors',
            staticAnchor: [16, 37],
            iconMe: L.icon({
                iconUrl: '/media/slider/logo_yellow.png',
                iconSize: [27, 30],
                iconAnchor: [16, 37]
            }),
            isLoading: false,
            selectedCountriesCode: [],
            selectedCountiesIds: [],
            form: {
                id: '',
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
                travelAddressIds: [],
                travelAddressCity: [],
                travelAddressCountry: [],
                travelAddressAdress: [],
                thumbs200ForCollectionArr: [],
                travelImageThumbUrlArr: [],
                travelImageAddress: [],
                categoriesIds:[]
            }
        }
    },
    methods: {

        init: function () {
            if (this.form.id) {
                this.$store.commit('SET_TRAVEL_ID', this.form.id);
            }
            this.travelAddress.id = this.form.travelAddressIds;
            this.travelAddress.address = this.form.travelAddressAdress;
            this.travelAddress.meCoord = this.form.coordsMeTravel;
            this.travelAddress.city = this.form.travelAddressCity;
            this.travelAddress.country = this.form.travelAddressCountry;
            this.travelAddress.thumbs200Collection = this.form.thumbs200ForCollectionArr;
            this.travelAddress.travelImageThumbUrl = this.form.travelImageThumbUrlArr;

            this.selectedCountiesIds = this.form.countryIds;
            this.selectedCountriesCode = this.form.countriesCode ?? [];
        },
        getPostData: function getPostData() {
            var _this3 = this;
            if (this.mediaCollections) {
                this.mediaCollections.forEach(function (collection, index, arr) {
                    if (_this3.form[collection]) {
                        console.warn("MediaUploader warning: Media input must have a unique name, '" + collection + "' is already defined in regular inputs.");
                    }
                    if (_this3.$refs[collection + '_uploader']) {
                        _this3.form[collection] = _this3.$refs[collection + '_uploader'].getFiles();
                    }

                    if (Array.isArray(_this3.$refs[collection + '_uploadercropArr'])) {
                        let uploadedImage = [];
                        _this3.$refs[collection + '_uploadercropArr'].forEach((upload, index) => {
                            uploadedImage.push(upload.getFilesDrag());
                            upload.clearFilesDrag();
                        });
                        _this3.form[collection] = uploadedImage;
                    }

                    if (_this3.$refs[collection + '_uploadercrop']) {
                        _this3.form[collection] = _this3.$refs[collection + '_uploadercrop'].getFilesDrag();
                        _this3.$refs[collection + '_uploadercrop'].clearFilesDrag();

                    }
                });
            }
            this.form['wysiwygMedia'] = this.wysiwygMedia;
            if (this.travelId && !this.form['id']) {
                this.form['id'] = this.travelId;
            }
            if (typeof this.travelAddressIds !== 'undefined' && this.travelAddressIds > 0) {
                this.form['travelAddressIds'] = this.travelAddressIds;
                this.travelAddress.id = this.travelAddressIds;
            }
            return this.form;
        },
        autoSave() {
            setInterval(() => {
                this.save();
            }, 300000)
        },
        save(event) {
            this.$store.commit('SET_SUBMITING_FORM', true);
            this.getPostData();
            this.$store.dispatch('AUTO_SAVE_TRAVEL', this.form);

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
        async getUsers() {
            let vm = this;
            axios.get('/api/users')
                .then(function (response) {
                    vm.optionsUsers = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        limitText(count) {
            return `и ${count} другие города`
        },
        searchCities: function (query) {
            if (this.selectedCountiesIds.length > 0) {
                this.$store.dispatch('SEARCH_CITIES', {'query': query, 'countryIds': this.selectedCountiesIds})
            }
        },
        customLabel({local_name = '', region_local_name = '', area_local_name = '', country_local_name = ''}) {
            let customLabel = `${local_name ? local_name : ''}
             ${region_local_name ? "-" + region_local_name : ''}
             ${area_local_name ? "-" + area_local_name : ''}
             ${country_local_name ? "-" + country_local_name : ''}`
            return customLabel;
        },
        getCitiesSelected: function (items) {
            items.forEach((item) => {
                this.selectedCountiesIds.push(item.country_id);
                this.selectedCountriesCode.push(item.country_code);
            });
            if (items.length > 1) {
                this.gecodingAddress(
                    {
                        country: items[items.length - 1].local_name ?? '',
                        region: items[items.length - 1].region_local_name ?? '',
                    },
                    false, true);
            }
        },
        onClick(e) {
            let coordOnClick = e.latlng;
            this.travelAddress.meCoord.push(coordOnClick);
            this.getAddress(coordOnClick);
        },
        setMarkerCity: function (item) {
            /*removecity in coord*/
            /*
            this.travelAddress.address.push(item.local_name);
            this.travelAddress.country.push(item.country_id);
            this.travelAddress.city.push(item.id);

            let search = [item.local_name, item.region_local_name, item.country_title_en].filter(Boolean).join(", ");
            this.gecodingAddress({
                    q: search
                },
                true, true);*/
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
                    vm.optionsCountries.forEach(function (item, index, array) {
                        if (item['country_code'] == country_code) {
                            vm.form.countries.push(item);
                            vm.selectedCountiesIds.push(item['country_id']);
                            vm.selectedCountriesCode.push(item['country_code']);
                            vm.travelAddress.country.push(item['country_id']);
                        }
                    });
                } else {
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
        },
        removeMarker: function (address, index) {
            this.form.cities = this.form.cities.filter(function (value, index, arr) {
                return (value.local_name != address);
            });
            this.$delete(this.travelAddress.id, index);
            this.$store.commit('SET_TRAVEL_ADDRESS_IDS', this.travelAddress.id);
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
        onToggleChange(id, event) { // added event as second arg
            let value = event.value;  // changed from event.target.value to event.value
        },

    },
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup,
        LTooltip,
        LIcon,
        Multiselect,
        'toggle-button':ToggleButton
    }
});

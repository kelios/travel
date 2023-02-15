<template>
    <div style="height:400px; width: 100%; padding-bottom: 40px;">

        <l-map
            :zoom="zoom"
            :center="center"
            ref="myMap"
            style="z-index: 0"
        >
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

            <div v-for="place in travelAddressArr">
                <l-marker
                    :lat-lng="getLatLng(place.coord)"
                    :icon="iconMe"
                >
                    <l-popup>
                        <a :href="place.urlTravel" target="_blank">
                            <img
                                v-if="place.travelImageThumbUrl"
                                class="mapPreview img-responsive img-thumbnail"
                                :src="place.travelImageThumbUrl"
                                width="200"
                                height="200"
                                alt = place.travelImageThumbUrl"
                            >
                            <div v-if="place.address">
                                <span class="badge badge-success">{{ __('travels.searchAddress') }} :</span>
                                <span class="coord">{{ place.address }}</span>
                            </div>
                            <div v-if="place.categoryName">
                                <span class="badge badge-success">{{
                                        __('travels.traveladdresscategory')
                                    }} :</span>
                                <span class="coord">{{ place.categoryName }}</span>
                            </div>
                        </a>

                    </l-popup>
                </l-marker>
            </div>

        </l-map>
    </div>
</template>

<script>
import L from "leaflet";
import 'leaflet/dist/leaflet.css';
import {LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon} from "vue2-leaflet";
import {mapGetters} from "vuex";

export default {
    name: "MapSearch",
    data: function () {
        return {
            coords: [],
            zoom: 8,
            center: L.latLng(50.5403576, 19.3672883),
            where: {},
            radius: {'id': 60, 'name': 60},

            url: 'https://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors',
            staticAnchor: [16, 37],
            iconMe: L.icon({
                iconUrl: '/media/slider/logo_yellow.png',
                iconSize: [27, 30],
                iconAnchor: [16, 37]
            }),
            isLoading: false,
            userLocation: [],
            geo_options: {
                enableHighAccuracy: true,
                maximumAge: 30000,
                timeout: 27000
            },
        }
    },
    mounted() {
        if(!this.lat)
            this.init();

    },
    computed: {
        ...
            mapGetters([
                'travelAddressArr',
                'lat',
                'lng'
            ]),

        dynamicSize() {
            return [this.iconSize, this.iconSize * 1.15];
        },
        dynamicAnchor() {
            return [this.iconSize / 2, this.iconSize * 1.15];
        },
        getLatLng: function () {
            return function (latlng) {
                if (latlng) {
                    let arraycoordMeTravel = latlng.split(',');
                    return {'lat': arraycoordMeTravel[0], 'lng': arraycoordMeTravel[1]}
                } else {
                    //if city or place not fount set MINSK @to do fix this
                    return {'lat': 53.8828449, 'lng': 27.7273595}
                }
            }
        },

    },
    methods: {
        initialZoom() {
            const map = this.$refs.myMap.mapObject;
            let arrayOfLatLngs = [];
            this.travelAddressArr.forEach((place) => {
                arrayOfLatLngs.push(this.getLatLng(place.coord))
            });
            if (arrayOfLatLngs.length > 0) {
                map.fitBounds([arrayOfLatLngs]);
            }
        },
        init(){
            navigator.geolocation.watchPosition(this.geo_success, this.geo_error, this.geo_options);
            var that = this;
            setTimeout(function () {
                that.initialZoom();
            }, 500);
        },
        geo_success(position) {
            this.center = L.latLng(position.coords.latitude, position.coords.longitude);
            this.$store.commit('SET_LAT', position.coords.latitude);
            this.$store.commit('SET_LNG', position.coords.longitude);
            this.getResults();
        },
        geo_error() {
            // for default set Minsk Belarus
            this.zoom = 8;
            this.$store.commit('SET_LAT', 53.8828449);
            this.$store.commit('SET_LNG', 27.7273595);
            this.center = L.latLng(this.lat, this.lng);
            this.getResults();


        },
        getResults(page = 1) {
            this.where.lat = this.lat;
            this.where.lng = this.lng;
            this.where.radius = this.radius;
            this.$store.dispatch('SEARCH_TRAVELS_ADDRESS', {'page': page, 'where': this.where})

        },
        getcoord2: function (indexCoord) {
            let arraycoordMeTravel = [];
            let res = [];
            this.travelAddressArr.meCoord[indexCoord].map(function (latlng) {
                arraycoordMeTravel = latlng.split(',');
                res.push({'lat': arraycoordMeTravel[0], 'lng': arraycoordMeTravel[1]});

            });
            return res;
        },

    },
    components: {
        'l-map': LMap,
        'l-tile-layer': LTileLayer,
        'l-marker': LMarker,
        LPopup,
        LTooltip,
        LIcon
    }
}

</script>


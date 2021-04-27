<template>
    <div style="height:500px; width: 100%">

        <l-map
            :zoom="zoom"
            :center="center"
            ref="myMap"
            style="z-index: 0"
        >
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

            <div v-for="(place,indexLat) in travelAddress">
                <l-marker
                    :lat-lng="getLatLng(place.coord)"
                    :icon="iconMe"
                >
                    <l-popup>
                        <a :href="place.urlTravel" target="_blank">
                            <img
                                lazy="loading"
                                v-if="place.travelImageThumbUrl"
                                class="mapPreview img-responsive img-thumbnail"
                                :src="place.travelImageThumbUrl"
                                width="200"
                                height="200"
                            >
                            <div class="badge-light">{{place.address}}</div>
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
                //   travelAddress: [],
                userLocation: [],
                geo_options: {
                    enableHighAccuracy: true,
                    maximumAge: 30000,
                    timeout: 27000
                },
            }
        },
        mounted() {
            var wpid = navigator.geolocation.watchPosition(this.geo_success, this.geo_error, this.geo_options);
        },
        computed: {
            ...
                mapGetters([
                    'travelAddress',
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
            geo_success(position) {
                console.log("geo_success");
                this.center = L.latLng(position.coords.latitude, position.coords.longitude);
                this.$store.commit('SET_LAT', position.coords.latitude);
                this.$store.commit('SET_LNG', position.coords.longitude);
                this.getResults();
            },
            geo_error() {
                // for default set Minsk Belarus
                console.log("not found position");
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
                this.travelAddress.meCoord[indexCoord].map(function (latlng) {
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


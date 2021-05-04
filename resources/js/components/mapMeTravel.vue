<template>
    <div style="height: 300px; width: 100%">

        <l-map
            :zoom="zoom"
            :center="center"
            ref="myMap"
            style="z-index: 0"
            @update:center="centerUpdate"
            @update:zoom="zoomUpdate"
        >
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <template v-for="place in  dots">
                <l-marker
                    :lat-lng="getLatLng(place.coord)"
                    :icon="iconMe"
                >
                    <l-popup
                    >
                        <a :href="place.urlTravel" target="_blank">
                            <img
                                lazy="loading"
                                v-if="place.travelImageThumbUrl"
                                class="img-responsive img-thumbnail"
                                :src="place.travelImageThumbUrl"
                                width="200"
                                height="200"
                            >
                            <div v-if="place.address">
                                <span class="badge badge-success">{{ translate('travels.searchAddress') }} :</span>
                                <span class="coord">{{ place.address }}</span>
                            </div>
                            <div v-if="place.categoryName">
                                <span class="badge badge-success">{{ translate('travels.traveladdresscategory') }} :</span>
                                <span class="coord">{{ place.categoryName }}</span>
                            </div>
                        </a>

                    </l-popup>
                </l-marker>
            </template>
        </l-map>
    </div>
</template>

<script>
import L from "leaflet";
import 'leaflet/dist/leaflet.css';
import {LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon} from "vue2-leaflet";
import {mapGetters} from "vuex";

export default {
    name: "mapMeTravel",
    props: ['dots'],
    data: function () {
        return {
            coords: [],
            zoom: 10,
            bounds: [],
            currentZoom: 11.5,
            currentCenter: L.latLng(53.8828449, 27.7273595),
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

        }
    },
    mounted() {
        this.$nextTick(() => {
            this.initialZoom()
        })
    },
    computed: {
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
        ...
            mapGetters([
                'travelAddress'
            ])
    },
    methods: {
        initialZoom() {
            const map = this.$refs.myMap.mapObject;
            let arrayOfLatLngs = [];
            this.dots.forEach((place) => {
                arrayOfLatLngs.push(this.getLatLng(place.coord))
            });
            map.fitBounds([arrayOfLatLngs]);
        },
        zoomUpdate(zoom) {
            this.currentZoom = zoom;
        },
        centerUpdate(center) {
            this.currentCenter = center;
        },
        getResults(page = 1) {
            if (this.data) {
                this.$store.dispatch('GET_TRAVELS', {'page': page, 'where': this.where})
            }
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

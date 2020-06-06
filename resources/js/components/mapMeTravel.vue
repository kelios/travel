<template>
    <div style="height: 300px; width: 100%">

        <l-map
            :zoom="zoom"
            :center="center"
            ref="myMap"
            style="z-index: 0"
        >
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <div v-for="(coordsMe,indexCoord) in  travelAddress.meCoord"  :key="`Record-${indexCoord}`">
                <l-marker
                    v-for="(latlng,indexLat) in getcoord(coordsMe)"
                    :lat-lng="latlng"
                    :key="`item-${indexCoord}-${indexLat}`"
                    :icon="iconMe"
                >
                    <l-popup
                        :content="'<a href='+travelAddress.url[indexCoord]+' target=\'_blank\'>'
                    +travelAddress.address[indexCoord][indexLat]+
                    '</a>'"
                    >
                    </l-popup>
                </l-marker>
            </div>
        </l-map>
    </div>
</template>

<script>
    import L from "leaflet";
    import {LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon} from "vue2-leaflet";
    import {mapGetters} from "vuex";

    export default {
        name: "mapMeTravel",
        props: ['data', 'where'],
        data: function () {
            return {
                coords: [],
                zoom: 2,
                center: L.latLng(53.8828449, 27.7273595),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                staticAnchor: [16, 37],
                iconMe: L.icon({
                    iconUrl: '/media/slider/logo_yellow.png',
                    iconSize: [27, 30],
                    iconAnchor: [16, 37]
                }),
                isLoading: false,
            }
        },
        created() {
            this.getResults();
            console.log(this.travelAddress);
        },
        computed: {
            groupedTravelAddress() {
                return _.chunk(this.travelAddress.meCoord, 15);
            },
            dynamicSize() {
                return [this.iconSize, this.iconSize * 1.15];
            },
            dynamicAnchor() {
                return [this.iconSize / 2, this.iconSize * 1.15];
            },
            getcoord: function () {
                let arraycoordMeTravel = [];
                let res = [];
                var vm = this;

                return function (coordsMe) {
                    coordsMe.map(function (latlng) {
                        arraycoordMeTravel = latlng.split(',');
                        res.push({'lat': arraycoordMeTravel[0], 'lng': arraycoordMeTravel[1]});
                    });
                    return res;
                }
            },
            ...
                mapGetters([
                    'travelAddress'
                ])
        },
        methods: {
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
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            LTooltip,
            LIcon
        }
    }

</script>

<style scoped>

</style>

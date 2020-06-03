<template>
    <div style="height: 300px; width: 100%">
        <div></div>
        <l-map
            :zoom="zoom"
            :center="center"
            ref="myMap"
            style="z-index: 0"
        >
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

            <l-marker
                v-for="(latlng,index) in travelAddress.meCoord"
                :lat-lng="latlng"
                :key="index"
            >
                <l-icon
                    :icon-anchor="staticAnchor"
                    class-name="someExtraClass"
                >
                    <div class="headline">
                        <a v-bind:href="travelAddress.url[index]" target="_blank">Me</a>
                    </div>
                </l-icon>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
    import L from "leaflet";
    import {LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon} from "vue2-leaflet";
    import {mapGetters} from "vuex";

    export default {
        name: "mapMeTravel",
        props: ['data','where'],
        data: function () {
            return {
                coords: [],
                zoom: 2,
                center: L.latLng(53.8828449, 27.7273595),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                staticAnchor: [16, 37],
                isLoading: false,
            }
        },
        created() {
            this.getResults();
        },
        computed: {
            groupedTravelAddress() {
                return _.chunk(this.travelAddress.meCoord, 15);
            },
            ...mapGetters([
                'travelAddress'
            ])
        },
        methods: {
            getResults(page = 1) {
                if (this.data) {
                    this.$store.dispatch('GET_TRAVELS', {'page': page, 'where':this.where})
                }
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

<template>

    <div class="container sidetravelmap">
        <div v-if="travelAddress.length>0">
            <div class="row" v-for="place in travelAddress">
                <div class="col-7 card">
                    <img
                        lazy="loading"
                        v-if="place.travelImageThumbUrl"
                        class="mapPreview img-responsive img-thumbnail"
                        :src="place.travelImageThumbUrl"
                        width="300"
                        height="300"
                    >
                    {{ place.address }}
                    <a :href="place.urlTravel" target="_blank">
                        {{translate('main.readMore')}}
                        <i class="fa fa-book" :title="translate('main.read')"></i>
                    </a>
                </div>

                <div class="col-5 card ">
                    <p v-if="place.categoryName">
                        <span class="badge badge-success">{{ translate('travels.traveladdresscategory')}} :</span>
                        <span>{{place.categoryName}}</span>
                    </p>
                    <p v-if="place.coord" class="textmenu">
                        <span class="badge badge-warning">{{ translate('travels.traveladdresscoord')}} :</span>
                        <span>{{place.coord}}</span>
                    </p>
                </div>

            </div>
        </div>

        <div class="row" v-else>{{ translate('main.searchNothing')}}</div>
    </div>

</template>

<script>

    import {mapGetters} from "vuex";

    export default {
        name: 'ShowTravel',

        mounted() {

        },
        computed: {
            ...
                mapGetters([
                    'travelAddress'
                ])
        },
        methods: {},
    }
</script>

<style scoped>

</style>

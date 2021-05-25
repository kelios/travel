<template>

    <div class="container sidetravelmap">
        <div v-if="travelAddressArr.length>0">
            <div class="row" v-for="place in travelAddressArr">
                <div class="col-12">
                    <div class="card col-mb-12">

                        <img
                            lazy="loading"
                            v-if="place.travelImageThumbUrl"
                            class="card-img-top"
                            :src="place.travelImageThumbUrl"
                        >
                        <div v-if="place.coord" class="textmenu">
                                    <span
                                        class="badge badge-warning">{{ __('travels.traveladdresscoord')}} :</span>
                            <span class="coord">{{place.coord}}</span>
                        </div>
                        <div>
                            <span class="badge badge-success">{{ __('travels.searchAddress')}} :</span>
                            <span class="coord">{{ place.address }}</span>
                        </div>
                        <div>
                            <span class="badge badge-success">{{ __('travels.traveladdresscategory')}} :</span>
                            <span class="coord">{{place.categoryName}}</span>
                        </div>
                        <a :href="place.urlTravel" target="_blank">
                            {{__('main.readMore')}}
                            <i class="fa fa-book" :title="__('main.read')"></i>
                        </a>


                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>{{ __('main.searchNothing')}}</div>
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
                    'travelAddressArr'
                ])
        },
        methods: {},
    }
</script>

<style scoped>

</style>

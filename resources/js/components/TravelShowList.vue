<template>
    <b-card-body
        id="nav-scroller"
        ref="content"
        style="position:relative; height:100%; overflow-y: scroll"
    >
        <section class="travel-section gallery section--demo-2 active" id="gallery" v-if="travel.gallery">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <slider :slides='travel.gallery'></slider>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid p-0">
            <section class="travel-section description" id="description" v-if="travel.description">
                <div class="travel-section-content">
                    <h2 class="mb-5">{{travel.name}}</h2>
                    <p class="lead mb-0" v-html="travel.description"></p>
                </div>
            </section>

            <section class="travel-section" id="plus" v-if="travel.plus">
                <travel-show-section :data="travel.plus"
                                     :title="__('travels.plus')"></travel-show-section>
            </section>

            <section class="travel-section" id="minus" v-if="travel.minus">
                <travel-show-section :data="travel.minus"
                                     :title="__('travels.minus')"></travel-show-section>
            </section>

            <section class="travel-section" id="recommendation" v-if="travel.recommendation">
                <travel-show-section :data="travel.recommendation"
                                     :title="__('travels.recommendation')"></travel-show-section>
            </section>

            <section class="travel-section ulmap" id="map" v-if="travel.travelAddressAdress">
                <div class="travel-section-content">
                    <h2>{{__('travels.map')}}</h2>
                    <map-me-travel :data="true" :where="where"></map-me-travel>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(address,index) in travel.travelAddressAdress" :key="index">
                            {{address}}-
                            {{travel.coordsMeTravelArr[index]}}
                        </li>
                    </ul>

                </div>
            </section>
            <section class="travel-section" id="comment">
                <comment :auth_user="auth_user" :travel="travel"></comment>
            </section>

        </div>
    </b-card-body>
</template>

<script>

    export default {
        name: 'TravelShowList',
        props: ['travel', 'where', 'auth_user'],
        created() {
        },
        computed: {

            getData() {
                if (Array.isArray(this.data)) {
                    return this.data.join(',');
                } else {
                    return this.data;
                }
            }

        },
        methods: {}
    }
</script>

<style scoped>
    img {
        object-fit: contain;
        height: 100% !important;
        width: 100%;
    }

    carousel-3d {
        margin-top: 10px;
        margin-bottom: 0px;
    }
</style>

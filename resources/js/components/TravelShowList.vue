<template>
    <b-card-body
        id="nav-scroller"
        ref="content"
        style="position:relative; height:100%; overflow-y: scroll"
        class="fixed-top-2"
    >
        <div class="container-fluid p-0">
            <section class="travel-section" id="description" v-if="travel.description">
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

            <section class="travel-section" id="gallery" v-if="travel.gallery">
                <carousel-3d :perspective="9" :controls-visible="true"
                             :width="1450" :height="757" :display="1" border="0">
                    <slide v-for="(slide, i) in travel.gallery" :index="i" :key="i">
                        <template slot-scope="{ index}">
                            <img :data-index="index"
                                 :src="slide.url">
                        </template>
                    </slide>
                </carousel-3d>
            </section>
        </div>
    </b-card-body>
</template>

<script>

    export default {
        name: 'TravelShowList',
        props: ['travel'],

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

<template>


    <swiper class="swiper" :options="swiperOption" style="
                            max-height: 700px;
                            ">

        <swiper-slide v-for="(slide, index) in travel.gallery" :key="index">

            <img
                lazy="loading"
                :srcset="slide.srcset "
                :src="slide.url"
                :class="slide-index"
                style=" max-height: 700px;
                            display:block;
                            margin:auto;
                            "
            >

        </swiper-slide>


        <div class="swiper-pagination swiper-pagination-white" slot="pagination"></div>
        <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
        <div class="swiper-button-next swiper-button-white" slot="button-next"></div>

    </swiper>


</template>

<script>
    import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'
    import 'swiper/css/swiper.css'
    import {mapGetters} from "vuex";

    export default {
        data() {
            return {
                swiperOption: {
                    spaceBetween: 30,
                    effect: 'fade',
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }
                }
            }
        },
        computed: {
            ...mapGetters([
                'travel',
            ])
        },
        components: {
            Swiper,
            SwiperSlide
        },
        directives: {
            swiper: directive
        },

    }
</script>


<template>


    <swiper  :slides-per-view="3"
             :space-between="30"
             navigation
             :pagination="{ clickable: true }"
             :scrollbar="{ draggable: true }"
             @swiper="onSwiper"
             @slideChange="onSlideChange"
             style="max-height: 700px;">

        <swiper-slide v-for="(slide, index) in travel.gallery" :key="index">

            <img
                alt = "image"
                :srcset="slide.srcset"
                :src="slide.url"
                :class="slide-index"
                style=" max-height: 700px;
                            display:block;
                            margin:auto;
                            "
            >

        </swiper-slide>
    </swiper>


</template>

<script>
    import { Navigation, Pagination, Scrollbar, A11y } from 'swiper';
    import { Swiper, SwiperSlide } from 'swiper/vue'
    import 'swiper/css';
    import 'swiper/css/navigation';
    import 'swiper/css/pagination';
    import 'swiper/css/scrollbar';

    import {mapGetters} from "vuex";

    export default {
        components: {
            Swiper,
            SwiperSlide,
        },
        setup() {
            const onSwiper = (swiper) => {
                console.log(swiper);
            };
            const onSlideChange = () => {
                console.log('slide change');
            };
            return {
                onSwiper,
                onSlideChange,
                modules: [Navigation, Pagination, Scrollbar, A11y],
            };
        },
        computed: {
            ...mapGetters([
                'travel',
            ])
        }
    }
</script>


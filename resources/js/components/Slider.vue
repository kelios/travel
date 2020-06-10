<template>
    <div>
        <agile class="pad-layout" :autoplay-speed="15000" autoplay :speed="600">
            <div class="slide" v-for="(slide, index) in slides" :key="index" :class="`slide--${index}`">
                <img :src="slide.url" />
            </div>
            <template slot="prevButton">
                <i class="fas fa-chevron-left"></i>
            </template>
            <template slot="nextButton">
                <i class="fas fa-chevron-right"></i>
            </template>
        </agile>
    </div>
</template>


<script>
    import {VueAgile} from 'vue-agile'

    export default {
        components: {
            VueAgile
        },
        props: ['slides'],

    }
</script>

<style>
    .agile__nav-button {
        background: transparent;
        border: none;
        color: #fff;
        cursor: pointer;
        font-size: 24px;
        height: 100%;
        position: absolute;
        top: 0;
        transition-duration: 0.3s;
        width: 80px;
    }
    .agile__nav-button--prev {
        left: 0;
    }
    .agile__nav-button--next {
        right: 0;
    }
    .agile__dots {
        bottom: 10px;
        left: 50%;
        position: absolute;
        transform: translateX(-50%);
    }
    .agile__dot {
        margin: 0 10px;
    }
    .agile__dot button{
        background-color: transparent;
        border: 1px solid #fff;
        border-radius: 50%;
        cursor: pointer;
        display: block;
        height: 10px;
        font-size: 0;
        line-height: 0;
        margin: 0;
        padding: 0;
        transition-duration: 0.3s;
        width: 10px;
    }
    .agile__dot--current button,
    .agile__dot button:hover {
        background-color: #fff;
    }

</style>

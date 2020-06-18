<template>

    <agile :autoplay-speed="15000" :speed="600">
        <img v-for="(slide, index) in slides" :key="index" :src="slide.url" class="slide"/>
        <template slot="prevButton">
            <i class="fas fa-chevron-left"></i>
        </template>
        <template slot="nextButton">
            <i class="fas fa-chevron-right"></i>
        </template>
    </agile>

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

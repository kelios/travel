<template>
    <b-card-body
        id="nav-scroller"
        ref="content"
        style="position:relative; height:100%; overflow-y: scroll"
        class="fixed-top-2"
    >
        <div class="container-fluid p-0">
            <section class="travel-section" id="description">
                <div class="travel-section-content">
                    <h2 class="mb-5">{{travel.name}}</h2>
                    <p class="lead mb-0" v-html="travel.description"></p>
                </div>
            </section>

            <section class="travel-section" id="plus">
                <travel-show-section :data="travel.plus"
                                     :title="__('travels.plus')"></travel-show-section>
            </section>

            <section class="travel-section" id="minus">
                <travel-show-section :data="travel.minus"
                                     :title="__('travels.minus')"></travel-show-section>
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

</style>

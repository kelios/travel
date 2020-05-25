<template>
    <b-card-body
        id="nav-scroller"
        ref="content"
        style="position:relative; height:100%; overflow-y: scroll"
        class="fixed-top-2"
    >
        <div class="container-fluid p-0"  >
            <section class="treavel-section" id="description">
                <div class="treavel-section-content">
                    <h1 class="mb-0">{{travel.name}}</h1>
                    <p class="lead mb-5" v-html="travel.description">
                    </p>
                </div>
            </section>

            <section class="treavel-section" id="plus">
                <travel-show-section :data="travel.plus"
                                     :title="trans('travels.plus')"></travel-show-section>
            </section>

            <section class="treavel-section" id="minus">
                <travel-show-section :data="travel.minus"
                                     :title="trans('travels.minus')"></travel-show-section>
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
        methods: {
        }
    }
</script>

<style scoped>

</style>

<template>
    <div>


            <filter-map></filter-map>


        <div class="row">
            <div class="col-md-12">
                <map-search></map-search>
            </div>
        </div>

                <show-travel></show-travel>

    </div>
</template>

<script>

    import FilterMap from './FilterMap.vue';
    import MapSearch from './MapSearch.vue';
    import ShowTravel from './ShowTravel.vue';

    export default {
        name: "FormSearch",
        components: {
            'filter-map': FilterMap,
            'map-search': MapSearch,
            'show-travel': ShowTravel
        },
        data: function () {
            return {}
        },
        created() {

        },
        methods: {},

    }

</script>

<style scoped>

</style>

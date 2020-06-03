<template>
    <div>
        <b-nav class="navbar-nav" v-b-scrollspy:nav-scroller>

            <b-nav-item class="nav-item" href="#gallery" v-if="travel.gallery">
                {{ __('travels.gallery') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#description" v-if="travel.description">
                {{ __('travels.description') }}
            </b-nav-item>


            <b-nav-item class="nav-item" href="#plus" v-if="travel.plus">
                {{ __('travels.plus') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#minus" v-if="travel.minus">
                {{ __('travels.minus') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#recommendation" v-if="travel.recommendation">
                {{ __('travels.recommendation') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#map" v-if="travel.travelAddressAdress">
                {{ __('travels.map') }}
            </b-nav-item>

        </b-nav>
    </div>
</template>

<script>

    export default {
        name: 'TravelShowMenu',
        props: ['travel'],
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

</style>

<template>
    <div>
        <b-nav class="navbar-nav" b-scrollspy:nav-scroller>
            <b-nav-item class="nav-item" href="#gallery" v-if="travel_menu.gallery">
                {{ __('travels.gallery') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#video" v-if="travel_menu.youtube_link">
                {{ __('travels.video') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#description" v-if="travel_menu.description">
                {{ __('travels.description') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#plus" v-if="travel_menu.plus">
                {{ __('travels.plus') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#minus" v-if="travel_menu.minus">
                {{ __('travels.minus') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#recommendation" v-if="travel_menu.recommendation">
                {{ __('travels.recommendation') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#travelRoad" v-if="travel_menu.travelRoad">
                {{ __('travels.travelRoad') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#map" v-if="travel_menu.travelAddressAdress">
                {{ __('travels.map') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#comment">
                {{ __('travels.comment') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#nearTravels">
                {{__('travels.nearTravels')}}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#popular">
                {{__('travels.popularTravels')}}
            </b-nav-item>
        </b-nav>
    </div>
</template>

<script>
    import { BNav , BNavItem } from 'bootstrap-vue-next';

    export default {
        name: 'TravelShowMenu',
        props: ['travel_menu'],
        components: {
            'b-nav': BNav,
            'b-nav-item': BNavItem
        },
        methods: {}
    }
</script>

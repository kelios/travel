<template>
    <div>
        <b-nav class="navbar-nav" v-b-scrollspy:nav-scroller>
            <li class="nav-item info">
                {{ travel.name }}
            </li>
            <li class="nav-item info" v-if="travel.year">
                {{ travel.year }}
                {{ travel.monthName }}
            </li>
            <li class="nav-item info" v-if="travel.countryName">
                {{ travel.countryName }}
            </li>
            <li class="nav-item info" v-if="travel.cityName">
                {{ travel.cityName }}
            </li>
            <li class="nav-item info" v-if="travel.number_days">
                {{ __('travels.number_days') }} - {{ travel.number_days }}
            </li>
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
            <b-nav-item class="nav-item" href="#gallery" v-if="travel.gallery">
                {{ __('travels.gallery') }}
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

<template>
    <div>
        <b-nav class="navbar-nav" v-b-scrollspy:nav-scroller>
            <b-nav-item class="nav-item" href="#gallery" v-if="travel_menu.gallery">
                {{ translate('travels.gallery') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#description" v-if="travel_menu.description">
                {{ translate('travels.description') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#plus" v-if="travel_menu.plus">
                {{ translate('travels.plus') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#minus" v-if="travel_menu.minus">
                {{ translate('travels.minus') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#recommendation" v-if="travel_menu.recommendation">
                {{ translate('travels.recommendation') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#travelRoad" v-if="travel_menu.travelRoad">
                {{ translate('travels.travelRoad') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#map" v-if="travel_menu.travelAddressAdress">
                {{ translate('travels.map') }}
            </b-nav-item>
            <b-nav-item class="nav-item" href="#comment" >
                {{ translate('travels.comment') }}
            </b-nav-item>
        </b-nav>
    </div>
</template>

<script>

    export default {
        name: 'TravelShowMenu',
        props: ['travel_menu','auth_user'],
        created() {
            console.log(this.travel_menu);
        },
        mounted() {
            console.log(this.travel_menu);
        },
       /* computed: {

            getData() {
                if (Array.isArray(this.data)) {
                    return this.data.join(',');
                } else {
                    return this.data;
                }
            }

        },*/
        methods: {}
    }
</script>

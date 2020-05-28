<template>

    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
        <a v-bind:href="travel.url"> <img :src="getCover(travel)" class="img-fluid rounded-circle mb-3"
                                                  :alt="travel.name">
            <h5>{{ travel.name }}</h5>
        </a>
        <p class="font-weight-light mb-0">
            <span>{{travel.countryName}}</span>
        </p>
    </div>

</template>

<script>
    export default {
        name: 'TravelCardLast',
        props: ['travel'],
        methods: {
            goAction: function (data) {
                window.location.href = data.url;
            },
            getCover: function (travel) {
                if (!travel.travel_image_thumb_url) {
                    return travel.categories ?
                        travel.categories[0].category_image_thumb_url : this.defImageTravel
                }
                return travel.travel_image_thumb_url
            }
        },
    }
</script>

<style scoped>

</style>

<template>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                <div v-for="travel in travels.data" :key="travel.id" class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <img
                            v-bind:src="travel.categories[0] ? travel.categories[0].category_image_thumb_url : defaultImage"
                            class="img-fluid">
                        <div class="card-body">
                            <p class="card-text">{{ travel.country }}</p>
                            <p class="card-text">{{ travel.city }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" v-on:click="goEdit({url: travel.url+'/edit' })"
                                            class="btn btn-sm btn-outline-secondary">
                                        {{ trans('main.edit')}}
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        {{trans('main.delete')}}
                                    </button>
                                </div>
                                <small class="text-muted">{{ travel.name }}</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TravelCard',
        props: ['travels'],
        data: function () {
            return {
                defaultImage: 'media/metravel.JPG'
            }
        },
        methods: {
            goEdit: function (data) {
                window.location.href = data.url;
            },
        },
        mounted() {
            //   console.log(this.defaultImage);
            //  console.log(this.travels.data[0].categories[0].category_image_thumb_url);
        }
    }
</script>

<style scoped>

</style>

<template>
    <div class="row">
        <div class="card mb-4 shadow-sm">
            <img
                :src="getCover(travel)"
                class="img-fluid" :alt="travel.name">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p>
                        <span>{{travel.countryName}}</span>

                    </p>
                    <p>
                        <span>{{travel.cityName}}</span>
                    </p>
                    <p>{{ travel.name }}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button"
                                v-on:click="goAction({url: travel.url+'/show' })"
                                class="btn btn-sm btn-spinner btn-success">
                            <i class="fa  fa-eye"></i>
                        </button>
                        <button v-if="!readonly" type="button"
                                v-on:click="goAction({url: travel.url+'/edit' })"
                                class="btn btn-sm btn-spinner btn-info">
                            <i class="fa fa-edit"></i>
                        </button>


                    </div>


                    <button v-if="!readonly" type="button" class="btn btn-sm btn-danger"
                            v-on:click="remove(travel.url)">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: 'TravelCard',
        props: ['travel', 'readonly'],
        created() {
            // this.data_travel = this.travel;
        },
        methods: {
            goAction: function (data) {
                window.location.href = data.url;
            },
            remove: function (url) {
                let vm = this;
                console.log('remove');
                axios.delete(url).then(function (response) {
                    vm.$emit('remove', vm.travel.id);
                }, function (error) {
                    console.log(error.response.data.messag);
                });
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

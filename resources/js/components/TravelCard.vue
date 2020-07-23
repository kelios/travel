<template>
    <div class="row justify-content-center">
        <div class="card col-11 shadow-sm">
            <img
                :src="travel.travel_image_thumb_url"
                class="img-fluid" :alt="travel.name">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-truncate">{{ travel.name }}</p>
                </div>


                <div class="d-flex justify-content-between align-items-center">
                    <p>
                        <span>{{travel.countryName}}</span>
                        <span v-if="travel.cityName"> - {{travel.cityName}}</span>
                    </p>
                    <p v-if="!readonly">
                        <span class="badge badge-success" v-if="travel.publish">{{__('main.puplish')}}</span>
                        <span class="badge badge-dark" v-else>{{__('main.hide')}}</span>
                    </p>
                </div>
                <div class="small text-right"> {{__('main.author')}} - {{travel.userName}}</div>
                <div class="d-flex justify-content-between align-items-center">
                    <p>
                        <a :href="'/travels/'+travel.slug" target="_blank">
                            {{__('main.readMore')}}
                        </a>
                    </p>


                    <div class="btn-group-sm">
                        <button v-if="!readonly" type="button" class="btn btn-sm btn-warning"
                                v-on:click="goAction({url: travel.url+'/edit' })">
                            {{__('main.edit')}}
                        </button>

                        <button v-if="!readonly" type="button" class="btn btn-sm btn-danger"
                                v-on:click="remove(travel.url)">
                            {{__('main.delete')}}
                        </button>
                    </div>
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
                axios.delete(url).then(function (response) {
                    vm.$emit('remove', vm.travel.id);
                }, function (error) {
                    console.log(error.response.data.messag);
                });
            },

        },
    }
</script>

<style scoped>

</style>

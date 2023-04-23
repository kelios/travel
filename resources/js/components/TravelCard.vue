<template>
    <div class="col-mb-11">

        <div class="card col-mb-11 box-shadow">
            <a :href="'/travels/'+travel.slug" target="_blank">
                <img
                    lazy="loading"
                    :src="travel.travel_image_thumb_url"
                    class="card-img-top"
                    :alt="travel.name"

                >
            </a>
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-truncate">{{ travel.name }}</p>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <p>
                        <span>{{ travel.countryName }}</span>
                        <span v-if="travel.cityName"> - {{ travel.cityName }}</span>
                    </p>
                    <p v-if="!readonly">
                        <span class="badge badge-success"
                              v-if="travel.publish && travel.moderation">{{ __('main.puplish') }}</span>
                        <span class="badge badge-dark"
                              v-else-if="travel.publish && !travel.moderation">{{ __('main.moderationhide') }}</span>
                        <span class="badge badge-dark" v-else>{{ __('main.hide') }}</span>
                    </p>
                </div>
                <div class="small text-right"> {{ __('main.author') }} - {{ travel.userName }}

                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p>
                        <a :href="'/travels/'+travel.slug" target="_blank">
                            {{ __('main.readMore') }}
                            <i class="fa fa-book" :title="__('main.read')"></i>
                            <span v-if="travel.countUnicIpView">
                            ({{ travel.countUnicIpView }})
                            </span>
                        </a>
                    </p>


                    <div class="btn-group-sm">
                        <button v-if="!readonly" type="button" class="btn btn-sm btn-warning"
                                v-on:click="goAction({url: travel.url+'/edit' })">
                            {{ __('main.edit') }}
                        </button>

                        <button v-if="!readonly" type="button" class="btn btn-sm btn-danger"
                                v-on:click="remove(travel.url)">
                            {{ __('main.delete') }}
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-xl-center">

                    <ShareNetwork
                        network="vk"
                        :url="travel.url"
                        :title="travel.name"
                        :description="travel.description"
                        :media="travel.travel_image_thumb_url"
                    >
                        <i class="fa fa-vk"></i>
                    </ShareNetwork>

                    <ShareNetwork
                        network="facebook"
                        :url="travel.url"
                        :title="travel.name"
                        :description="travel.description"
                        :media="travel.travel_image_thumb_url"
                    >
                        <i class="fa fa-share fa-facebook fa-x fa-fw"></i>
                    </ShareNetwork>


                </div>

            </div>
        </div>

    </div>

</template>
<script>
export default {
    name: "TravelCard",
};
</script>
<script setup>

import {useStore} from "vuex";
import {computed} from "vue";

console.log('TRAVELCARD')
const store = useStore()

const props = defineProps({
    readonly: Boolean,
    travel: Array,

});

const travel = computed(() => {
    return props.travel;
});

const readonly = computed(() => {
    return props.readonly;
});

function goAction(data) {
    window.location.href = data.url;
}

function remove(url) {
    store.dispatch('DELETE_TRAVEL', {url})
    // Axios.delete(url);
    // store.dispatch('DELETE_TRAVEL', {'id': travel.id})
    //axios.delete(url).then(function (response) {
    //   $emit('remove', travel.id);

}


</script>

<style scoped>

</style>

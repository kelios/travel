<template>
    <div
        id="nav-scroller"
        ref="content"
        class="travelshowlist"
    >
        <section class="travel-section gallery section--demo-2" id="gallery" v-if="travel.gallery">
            <h2 class="mb-5 galleryTitle">{{ __('travels.gallery') }}</h2>
            <div>
                <slider></slider>
            </div>
        </section>

        <section class="travel-section video section--demo-2" id="video" v-if="travel.youtube_link">
            <div>
                <video-embed :src="travel.youtube_link"></video-embed>
            </div>

        </section>
        <section class="travel-section description" id="description" v-if="travel.description">
            <div class="travel-section-content">
                <h2 class="mb-5">{{ travel.name }}</h2>
                <ul class="list-group list-group-flush textmenu">
                    <li class="small" v-if="travel.categoryName">
                        {{ __('travels.categories') }} - {{ travel.categoryName }}
                    </li>

                    <li class="small" v-if="travel.complexityName">
                        {{ __('travels.complexity') }} - {{ travel.complexityName }}
                    </li>

                    <li class="small" v-if="travel.transportName">
                        {{ __('travels.transports') }} - {{ travel.transportName }}
                    </li>
                    <li class="small" v-if="travel.overNightStayName">
                        {{ __('travels.overNightStay') }} - {{ travel.overNightStayName }}
                    </li>

                    <li class="small" v-if="travel.budget">
                        {{ __('travels.budget') }} - {{ travel.budget }}
                    </li>

                    <li class="small" v-if="travel.number_peoples">
                        {{ __('travels.number_peoples') }} - {{ travel.number_peoples }}
                    </li>
                </ul>
                <hr>
                <p class="lead mb-0" v-html="travel.description"></p>
            </div>
        </section>

        <section class="travel-section plus" id="plus" v-if="travel.plus">
            <div class="travel-section-content">
                <h2 class="mb-5">{{ __('travels.plus') }}</h2>
                <p class="lead mb-0" v-html="travel.plus"></p>
            </div>
        </section>

        <section class="travel-section minus" id="minus" v-if="travel.minus">

            <div class="travel-section-content">
                <h2 class="mb-5">{{ __('travels.minus') }}</h2>
                <p class="lead mb-0" v-html="travel.minus"></p>
            </div>

        </section>

        <section class="travel-section recommendation" id="recommendation" v-if="travel.recommendation">
            <div class="travel-section-content">
                <h2 class="mb-5">{{ __('travels.recommendation') }}</h2>
                <p class="lead mb-0" v-html="travel.recommendation"></p>
            </div>
        </section>

        <section class="travel-section" id="travelRoad" v-if="travel.travelRoadFilename">
            <div class="container-fluid">
                <h2 class="mb-5">{{ __('travels.travelRoad') }} - {{ travel.travelRoadFilename }}</h2>
                <div class="row">
                    <div class="col-xs-12">
                        <a :href="travel.travelRoadUrl" download depressed small color="primary">
                            {{ __('travels.travelRoad') }} - {{ travel.travelRoadFilename }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="travel-section ul map" id="map" v-if="travel.travelAddress">
            <div class="travel-section-content">
                <h2>{{ __('travels.map') }}</h2>
                <map-me-travel :dots="travel.travelAddress"></map-me-travel>
                <ul class="list-group">
                    <li class="list-group-item" v-for="place in travel.travelAddress">
                        <img
                            lazy="loading"
                            v-if="place.travelImageThumbUrl"
                            class="mapPreview img-responsive img-thumbnail"
                            :src="place.travelImageThumbUrl"
                        >
                        <div v-if="place.coord" class="textmenu">
                                    <span
                                        class="badge badge-warning">{{
                                            __('travels.traveladdresscoord')
                                        }} :</span>
                            <span class="coord">{{ place.coord }}</span>
                        </div>
                        <div>
                            <span class="badge badge-success">{{ __('travels.searchAddress') }} :</span>
                            <span class="coord">{{ place.address }}</span>
                        </div>
                        <div>
                            <span class="badge badge-success">{{ __('travels.traveladdresscategory') }} :</span>
                            <span class="coord">{{ place.categoryName }}</span>
                        </div>

                    </li>
                </ul>
            </div>
        </section>

        <section class="travel-section comments-app comment" id="comment" v-if="travel.description">
            <h1>{{ __('travels.comment') }}</h1>
            <div class="comment-form" v-if="authUserId">
                <div class="comment-avatar">
                    <img lazy="loading" :src="authUserAvatar">
                </div>
                <div class="form">
                    <div class="form-row">
                    <textarea type="text" class="form-control"
                              v-model="travel.reply"
                              :placeholder="__('travels.addcomment')"
                    ></textarea>
                    </div>
                    <div class="form-row">
                        <input class="input" placeholder="Name" type="text" disabled :value="authUserName">
                    </div>
                    <div class="form-row">
                        <input type="button" class="btn btn-success"
                               v-on:click="comment(travel.reply,travel.id)"
                               :value="__('travels.addcomment')">
                    </div>
                </div>
            </div>

            <comment-list v-if="travelComments" :collection="travelComments"
                          :comments="travelComments.root"
                          :where="where"
            ></comment-list>
        </section>

        <section class="travel-section" id="nearTravels" v-if="travel.description">
            <travel-near></travel-near>
        </section>

        <section class="travel-section" id="popular" v-if="travel.description">
            <h1>{{ __('travels.popularTravels') }}</h1>
            <travel-popular></travel-popular>
        </section>


    </div>
</template>

<script>
import _ from 'lodash';
import TravelNear from './TravelNear.vue';
import TravelPopular from './TravelPopular.vue';
import TravelShowSection from './TravelShowSection.vue';
import Slider from './Slider.vue';
import CommentList from './CommentList.vue';

import {BCard} from 'bootstrap-vue-next';
import {mapGetters} from "vuex";


export default {
    name: 'TravelShowList',
    props: ['travel_id', 'where'],
    data() {
        return {}
    },
    components: {
        'comment-list': CommentList,
        'travel-near': TravelNear,
        'travel-popular': TravelPopular,
        'travel-show-section': TravelShowSection,
        'slider': Slider,
        'b-card-body': BCard,
    },
    created() {
        this.getTravelData();
        this.getTravelCommentsData();
    },
    computed: {
     /*   getData() {
            if (Array.isArray(this.data)) {
                return this.data.join(',');
            } else {
                return this.data;
            }
        },*/
        groupedComments() {
            return _.chunk(this.travelComments, 15);
        },
        ...mapGetters([
            'travelComments',
            'travel',
        ])
    },
    methods: {
        getTravelCommentsData() {
            this.$store.dispatch('GET_TRAVEL_COMMENTS', {'where': this.where});
        },
        getTravelData() {
            this.$store.dispatch('GET_TRAVEL', {'travel_id': this.travel_id});
        },
        async comment(travelReply, travelId) {
            axios.post('/comments', {
                comment: travelReply,
                travel_id: travelId,
                users_id: this.authUserId
            }).then(response => {
                if (!response.data.error) {
                    this.travel.reply = '';
                    this.getTravelCommentsData();
                }
            });
        }
    }
}
</script>

<style scoped>
img {
    object-fit: contain;
    height: 100% !important;
    width: 100%;
}

carousel-3d {
    margin-top: 10px;
    margin-bottom: 0px;
}
</style>

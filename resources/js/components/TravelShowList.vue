<template>
    <b-card-body
        id="nav-scroller"
        ref="content"
        class="travelshowlist"
    >
        <section class="travel-section gallery section--demo-2 active" id="gallery" v-if="travel.gallery">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <slider :slides='travel.gallery'></slider>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid p-0">
            <section class="travel-section description" id="description" v-if="travel.description">
                <div class="travel-section-content">
                    <h2 class="mb-5">{{travel.name}}</h2>
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

            <section class="travel-section" id="plus" v-if="travel.plus">
                <travel-show-section :data="travel.plus"
                                     :title="__('travels.plus')"></travel-show-section>
            </section>

            <section class="travel-section" id="minus" v-if="travel.minus">
                <travel-show-section :data="travel.minus"
                                     :title="__('travels.minus')"></travel-show-section>
            </section>

            <section class="travel-section" id="recommendation" v-if="travel.recommendation">
                <travel-show-section :data="travel.recommendation"
                                     :title="__('travels.recommendation')"></travel-show-section>
            </section>

            <section class="travel-section ulmap" id="map" v-if="travel.travelAddressAdress">
                <div class="travel-section-content">
                    <h2>{{__('travels.map')}}</h2>
                    <map-me-travel :data="true" :where="where"></map-me-travel>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(address,index) in travel.travelAddressAdress" :key="index">
                            {{address}}-
                            {{travel.coordsMeTravelArr[index]}}
                        </li>
                    </ul>

                </div>
            </section>
            <section class="travel-section comments-app" id="comment">
                <h1>{{__('travels.comment')}}</h1>
                <div class="comment-form" v-if="auth_user">
                    <div class="comment-avatar">
                        <img :src="auth_user.user_avatar_thumb_url">
                    </div>
                    <div class="form">
                        <div class="form-row">
                    <textarea type="text" class="form-control"
                              v-model="travel.reply"
                              :placeholder="__('travels.addcomment')"
                    ></textarea>
                        </div>
                        <div class="form-row">
                            <input class="input" placeholder="Name" type="text" disabled :value="auth_user.name">
                        </div>
                        <div class="form-row">
                            <input type="button" class="btn btn-success"
                                   v-on:click="comment(travel)"
                                   :value="__('travels.addcomment')">
                        </div>
                    </div>
                </div>

                <comment-list v-if="travelComments" :collection="travelComments"
                              :comments="travelComments.root"
                              :auth_user="auth_user"
                              :where="where"
                ></comment-list>
            </section>

        </div>
    </b-card-body>
</template>

<script>
    import CommentList from './CommentList.vue';
    import {mapGetters} from "vuex";

    export default {
        name: 'TravelShowList',
        props: ['travel', 'where', 'auth_user'],
        data() {
            return {}
        },
        components: {
            'comment-list': CommentList
        },
        created() {
            this.getTravelCommentsData();
        },
        computed: {
            getData() {
                if (Array.isArray(this.data)) {
                    return this.data.join(',');
                } else {
                    return this.data;
                }
            },
            groupedComments() {
                return _.chunk(this.travelComments, 15);
            },
            ...mapGetters([
                'travelComments'
            ])
        },
        methods: {
            getTravelCommentsData() {
                this.$store.dispatch('GET_TRAVEL_COMMENTS', {'where': this.where});
            },
            comment(travel) {
                axios.post('/comments', {
                    comment: travel.reply,
                    travel_id: travel.id,
                    users_id: this.auth_user.id
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

<template>
    <b-card-body
        id="nav-scroller"
        ref="content"
        class="travelshowlist"
    >
        <section class="travel-section gallery section--demo-2" id="gallery" v-if="travel.gallery">
            <div class="container">
                <slider :slides='travel.gallery'></slider>
            </div>

        </section>

        <section class="travel-section description" id="description" v-if="travel.description">
            <div class="travel-section-content">
                <h2 class="mb-5">{{travel.name}}</h2>
                <ul class="list-group list-group-flush textmenu">
                    <li class="small" v-if="travel.categoryName">
                        {{ translate('travels.categories') }} - {{ travel.categoryName }}
                    </li>

                    <li class="small" v-if="travel.complexityName">
                        {{ translate('travels.complexity') }} - {{ travel.complexityName }}
                    </li>

                    <li class="small" v-if="travel.transportName">
                        {{ translate('travels.transports') }} - {{ travel.transportName }}
                    </li>
                    <li class="small" v-if="travel.overNightStayName">
                        {{ translate('travels.overNightStay') }} - {{ travel.overNightStayName }}
                    </li>

                    <li class="small" v-if="travel.budget">
                        {{ translate('travels.budget') }} - {{ travel.budget }}


                    <li class="small" v-if="travel.number_peoples">
                        {{ translate('travels.number_peoples') }} - {{ travel.number_peoples }}
                    </li>
                </ul>
                <hr>
                <p class="lead mb-0" v-html="travel.description"></p>
            </div>
        </section>

        <section class="travel-section plus" id="plus" v-if="travel.plus">
            <travel-show-section :data="travel.plus"
                                 :title="translate('travels.plus')"></travel-show-section>
        </section>

        <section class="travel-section minus" id="minus" v-if="travel.minus">
            <travel-show-section :data="travel.minus"
                                 :title="translate('travels.minus')"></travel-show-section>
        </section>

        <section class="travel-section" id="recommendation" v-if="travel.recommendation">
            <travel-show-section :data="travel.recommendation"
                                 :title="translate('travels.recommendation')"></travel-show-section>
        </section>

        <section class="travel-section" id="travelRoad" v-if="travel.travelRoad">
            <div class="container-fluid">
                <h2 class="mb-5">{{translate('travels.travelRoad') }} - {{travel.travelRoad.file_name}}</h2>
                <div class="row">
                    <div class="col-xs-12">
                        <a :href="travel.travelRoad.url" download depressed small color="primary">
                            {{translate('travels.travelRoad') }} - {{travel.travelRoad.file_name}}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="travel-section ul map" id="map" v-if="travel.travelAddressAdress">
            <div class="travel-section-content">
                <h2>{{translate('travels.map')}}</h2>
                <map-me-travel :data="true" :where="where"></map-me-travel>
                <ul class="list-group">
                    <li class="list-group-item" v-for="(address,index) in travel.travelAddressAdress" :key="index">
                        {{address}}-
                        {{travel.coordsMeTravelArr[index]}}
                    </li>
                </ul>
            </div>
        </section>
        <section class="travel-section comments-app comment" id="comment">
            <h1>{{translate('travels.comment')}}</h1>
            <div class="comment-form" v-if="authUserId">
                <div class="comment-avatar">
                    <img :src="authUserAvatar">
                </div>
                <div class="form">
                    <div class="form-row">
                    <textarea type="text" class="form-control"
                              v-model="travel.reply"
                              :placeholder="translate('travels.addcomment')"
                    ></textarea>
                    </div>
                    <div class="form-row">
                        <input class="input" placeholder="Name" type="text" disabled :value="authUserName">
                    </div>
                    <div class="form-row">
                        <input type="button" class="btn btn-success"
                               v-on:click="comment(travel)"
                               :value="translate('travels.addcomment')">
                    </div>
                </div>
            </div>

            <comment-list v-if="travelComments" :collection="travelComments"
                          :comments="travelComments.root"
                          :where="where"
            ></comment-list>
        </section>


    </b-card-body>
</template>

<script>
    import CommentList from './CommentList.vue';
    import {mapGetters} from "vuex";

    export default {
        name: 'TravelShowList',
        props: ['travel_id', 'where'],
        data() {
            return {}
        },
        components: {
            'comment-list': CommentList
        },
        created() {
            this.getTravelData();

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
                'travelComments',
                'travel'
            ])
        },
        methods: {
            getTravelCommentsData() {
                this.$store.dispatch('GET_TRAVEL_COMMENTS', {'where': this.where});
            },
            getTravelData() {
                this.$store.dispatch('GET_TRAVEL', {'travel_id': this.travel_id});
            },
            comment(travel) {
                axios.post('/comments', {
                    comment: travel.reply,
                    travel_id: travel.id,
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

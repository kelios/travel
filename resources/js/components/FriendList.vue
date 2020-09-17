<template>
    <div class="container">

        <div class="card">
            <div class="card-header blue">
                {{__('user.sendReq')}}
            </div>
            <div v-if="friendsPending" class="col-md-12 col-sm-12" v-for="friendPending in friendsPending">
                <friend-card v-if="friendPending.recipient.id!=user.id" class="animated fadeIn"
                             :friend="friendPending.recipient"
                             :isAccept="false"></friend-card>
            </div>
        </div>

        <div class="card" v-if="user.accepted_friends_count>0">
            <div class="card-header blue">
                {{__('user.waitApprove')}}
            </div>
            <div v-if="friendsPending" class="col-md-12 col-sm-12" v-for="friendPending in friendsPending">
                <friend-card v-if="friendPending.recipient.id==user.id" class="animated fadeIn"
                             :friend="friendPending.sender"
                             :isAccept="true"
                             @remove="removeFromFriendsPendingList"
                >

                </friend-card>
            </div>
        </div>

        <div class="card">
            <div class="card-header blue">
                {{__('user.friend')}}
            </div>
            <pagination :data="friends" :limit="5" align="center" @pagination-change-page="getResults"></pagination>
            <div class="" v-for="friendEvent in groupedFriends">
                <div class="col-md-12 col-sm-12" v-for="friend in friendEvent">
                    <friend-card class="animated fadeIn"
                                 @remove="removeFromFriendsList"
                                 :readonly="readonly"
                                 :friend="friend"
                                 isRemove="true"></friend-card>
                </div>
                <div class="col w-100"></div>
            </div>
            <pagination :data="friends" :limit="5" align="center" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>

<script>
    import friend from "./FriendCard";
    import pagination from "laravel-vue-pagination";
    import {mapGetters} from "vuex";

    export default {
        name: "FriendList",
        props: ['readonly', 'where', 'user'],
        data() {
            return {
                friendsPending: []
            }
        },
        components: {
            friend,
            pagination
        },
        http: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        mounted() {
            this.getResults();
            this.getPendingFriends();
            console.log(this.friends);
            /*  window.Echo.channel('search')
                  .listen('.searchResults', (e) => {
                      this.$store.commit('SET_FRIENDS', e.friends)
                  })*/
        },
        computed: {
            groupedFriends() {
                return _.chunk(this.friends.data, 15);
            },
            ...mapGetters([
                'friends'
            ])
        },
        methods: {
            removeFromFriendsPendingList(id) {
                this.friendsPending = this.friendsPending.filter(friend => friend.sender_id !== id)
            },
            removeFromFriendsList(id) {
                console.log('removeFromFriendsList');
                console.log(id);
                this.friends.data = this.friends.data.filter(friend => friend.id !== id)
            },
            getResults(page = 1) {
                this.$store.dispatch('GET_FRIENDS', {'page': page, 'where': this.where});
            },
            getPendingFriends() {
                axios.get('/api/friendsPending')
                    .then(response => {
                        this.friendsPending = response.data;
                    })
                    .catch()
            }
        },
    }
</script>

<style scoped>

</style>

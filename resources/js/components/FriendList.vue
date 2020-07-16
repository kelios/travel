<template>
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>{{__('user.sendReq')}}</h3>
            </div>
            <div v-if="friendsPending" class="col-md-12 col-sm-12" v-for="friendPending in friendsPending">
                <friend-card v-if="friendPending.recipient.id!=user.id" class="animated fadeIn"
                             :friend="friendPending.recipient"
                             :isAccept="false"></friend-card>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>{{__('user.waitApprove')}}</h3>
            </div>
            <div v-if="friendsPending" class="col-md-12 col-sm-12" v-for="friendPending in friendsPending">
                <friend-card v-if="friendPending.recipient.id==user.id" class="animated fadeIn"
                             :friend="friendPending.sender"
                             :isAccept="true"></friend-card>
            </div>
        </div>


        <pagination :data="friends" @pagination-change-page="getResults"></pagination>
        <div class="row" v-for="friendEvent in groupedFriends">
            <div class="col-md-12 col-sm-12" v-for="friend in friendEvent">
                <friend-card class="animated fadeIn" :readonly="readonly" :friend="friend"
                             @remove="removeFromList"></friend-card>
            </div>
            <div class="col w-100"></div>
        </div>
        <pagination :data="friends" @pagination-change-page="getResults"></pagination>

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
            removeFromList(id) {
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

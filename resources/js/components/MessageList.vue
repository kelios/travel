<template>
    <div class="row">

        <div class="col-md">
            <ul class="navbar-nav" v-if="messages.data" v-for="thread in messages.data">
                <div v-for="user in thread.users">
                    <li class="nav-item" v-if="user.id != authUserId">
                        <a>
                            <img class="avatar-photo" :src="user.user_avatar_thumb_url">
                            {{ user.name }}
                        </a>
                    </li>

                </div>
            </ul>
        </div>
        <div class="col-md">
            <div class="list-message">
                <div class="modal-content ">
                    <div v-if="messages.data" class="col-md-12 col-sm-12"
                         v-for="mes in messages.data[0].messages_latest">
                        <div v-if="mes.user_id == authUserId" class="alert alert-primary text-right">
                            {{mes.body}}
                        </div>
                        <div v-if="mes.user_id != authUserId" class="alert alert-dark text-left ">
                            {{mes.body}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import friend from "./FriendCard";
    import pagination from "laravel-vue-pagination";
    import {mapGetters} from "vuex";

    export default {
        name: "MessageList",
        props: [],
        data() {
            return {
            }
        },
        http: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        mounted() {
            console.log(this.authUserId);
            this.getResults();
        },
        computed: {
            groupedMessages() {
                return _.chunk(this.messages.data, 15);
            },
            ...mapGetters([
                'messages'
            ])
        },
        methods: {
            getResults(page = 1) {
                this.$store.dispatch('GET_MESSAGES', {'page': page, 'where': this.where});
            },

        },
    }
</script>

<style scoped>

</style>

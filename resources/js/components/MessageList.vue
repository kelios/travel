<template>
    <div>
        <b-row>
            <b-col cols="3">
                <b-sidebar z-index="1" visible id="sidebar-no-header" title="Sidebar" no-header
                           sidebar-class="topmetravel">
                    <div class="px-3 py-2">
                        <b-list-group class="paddingtop3">
                            <b-button class="showForMenu" v-b-toggle.sidebar-no-header>
                                {{translate('user.toogle_user_mes')}}
                            </b-button>
                            <div v-if="usersMessages" v-for="thread in usersMessages">
                                <div v-for="user in thread.users">
                                    <b-list-group-item :href="'#usermess'+user.id" v-if="user.id != authUserId"
                                                       v-on:click="getCorrespondence(1,user.id,user.name)">
                                        <img class="avatar-photo" :src="user.user_avatar_thumb_url">
                                        {{ user.name }}
                                        <span v-if = "thread.unreadMessageForAuthUser" class="badge badge-secondary">
                                        {{thread.unreadMessageForAuthUser }}
                                    </span>
                                    </b-list-group-item>
                                </div>
                            </div>
                        </b-list-group>
                    </div>
                </b-sidebar>
            </b-col>
            <b-col cols="9">
                <div class="card">
                    <div class="card-header text-align">
                        <div class="card-title"> {{translate('travels.messageWith')}}
                            {{userName}}
                        </div>
                        <b-button v-b-toggle.sidebar-no-header>{{translate('user.toogle_user_mes')}}</b-button>

                    </div>

                    <message-send :messagesBetween="messagesBetween"
                                  :recipient_id="showMessageUser">
                    </message-send>

                    <div class="card-body scroll">
                        <pagination :data="messagesBetween" :limit="4" align="center"
                                    @pagination-change-page="getMes"></pagination>
                        <div v-if="messagesBetween.data" v-for="mes in messagesBetween.data">
                            <div v-if="mes.user_id == authUserId" class="alert alert-primary text-right">
                                {{mes.body}}
                            </div>
                            <div v-if="mes.user_id != authUserId" class="alert alert-dark text-left ">
                                {{mes.body}}
                            </div>
                        </div>

                        <pagination :data="messagesBetween" :limit="4" align="center"
                                    @pagination-change-page="getMes"></pagination>

                    </div>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>

    import {mapGetters} from "vuex";


    export default {
        name: "MessageList",
        props: [],
        data() {
            return {
                showMessageUser: '',
                userName: '',
                where: []
            }
        },
        http: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        created() {
            this.getUsers();
        },
        watch: {
            usersMessages: function (newUser, oldUser) {
                if (oldUser == null) {
                    if (this.usersMessages[0].users[0].id != this.authUserId) {
                        this.getCorrespondence(1, this.usersMessages[0].users[0].id, this.usersMessages[0].users[0].name);
                    }else{
                        this.getCorrespondence(1, this.usersMessages[0].users[1].id, this.usersMessages[0].users[1].name);
                    }
                }
            }
        },
        computed: {
            ...mapGetters([
                'messages',
                'usersMessages',
                'messagesBetween'
            ]),

        },
        methods: {
            getResults(page = 1) {
                this.$store.dispatch('GET_MESSAGES', {'page': page, 'where': this.where});
            },
            getUsers(page = 1) {
                this.$store.dispatch('GET_USERS_MESSAGES', {'page': page, 'where': this.where});
            },
            getMes(page = 1) {
                this.getCorrespondence(page, this.showMessageUser, this.userName);
            },
            getCorrespondence(page = 1, idUser = '', userName = '') {
                if (idUser) {
                    this.userName = userName;
                    this.showMessageUser = idUser;
                    this.where['id'] = idUser;
                }
                this.$store.dispatch('GET_MESSAGES_BETWEEN', {'page': page, 'where': this.where});
            },
            isMobile() {
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    return true
                } else {
                    return false
                }
            }

        },
    }
</script>

<style scoped>

</style>

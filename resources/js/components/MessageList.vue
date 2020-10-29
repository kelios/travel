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
                                                       v-on:click="setUser(user.id,user.name,
                                                       thread.unreadMessageForAuthUser,
                                                       thread.id)">
                                        <img class="avatar-photo" :src="user.user_avatar_thumb_url">
                                        {{ user.name }}
                                        <span v-if="thread.unreadMessageForAuthUser" class="badge badge-secondary">
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
                    <message-send v-if="usersMessages.length" v-bind:recipient_id="showMessageUser"></message-send>
                    <div class="card-body scroll">
                        <div v-if="usersMessages.length==0">{{translate('user.nomessage')}}</div>
                        <message-between-list v-bind:recipient_id="showMessageUser"></message-between-list>
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

                if (oldUser == null || Object.keys(this.usersMessages).length !== 0) {
                    if (this.usersMessages[0].users[0].id != this.authUserId) {
                        this.userName = this.usersMessages[0].users[0].name;
                        this.showMessageUser = this.usersMessages[0].users[0].id;
                    } else {

                        this.userName = this.usersMessages[0].users[1].name;
                        this.showMessageUser = this.usersMessages[0].users[1].id;

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
            getUsers(page = 1) {
                this.$store.dispatch('GET_USERS_MESSAGES', {'page': page, 'where': this.where});
            },
            setUser(idUser = '', userName = '', unreadMessageCount = 0, threadId) {
                if (idUser) {
                    this.userName = userName;
                    this.showMessageUser = idUser;
                }
                if (unreadMessageCount && threadId) {
                    this.markUsRead(threadId);
                }
            },
            markUsRead(threadId) {
                axios.put('/api/messages/markUsRead/' + threadId).then(response => {
                });
            }


        },
    }
</script>

<style scoped>

</style>

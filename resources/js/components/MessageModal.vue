<template>
    <modal :show="show">
        <header
            id="modalTitle"
            class="modal-header"
        >
            {{ translate('travels.messageWith',travel_user_name)}} {{travel_user_name}}
            <button
                type="button"
                class="btn-close"
                aria-label="Close modal"
                @click="close"
            >
                x
            </button>
        </header>

        <section
            id="modalDescription"
            class="modal-body"
        >
            <div class="comment-form">
                <div class="comment-avatar">
                    <img :src="auth_user.user_avatar_thumb_url">
                </div>
                <div class="form">
                    <div class="form-row">
                    <textarea type="text" class="form-control"
                              v-model="content"
                              :placeholder="translate('travels.addMessage')"
                    ></textarea>
                    </div>
                    <div class="form-row">
                        <input class="input" placeholder="Name" type="text" disabled :value="auth_user.name">
                    </div>
                    <div class="form-row">
                        <input type="button" class="btn btn-success"
                               v-on:click="sendTo()"
                               :value="translate('travels.sendMessage')">
                    </div>
                </div>
            </div>
        </section>
        <pagination :data="messages" :limit="4" align="center" @pagination-change-page="getMessages"></pagination>
        <div class="list-message">
            <div class="modal-content ">
                <div v-if="messages.data" class="col-md-12 col-sm-12" v-for="thread in messages.data">
                    <div class="col-md-12 col-sm-12" v-for="mes in thread.messages_latest">
                        <div v-if="mes.user_id == auth_user.id" class="alert alert-primary text-right">
                            {{mes.body}}
                        </div>
                        <div v-if="mes.user_id != auth_user.id" class="alert alert-dark text-left ">
                            {{mes.body}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <pagination :data="messages" :limit="4" align="center" @pagination-change-page="getMessages"></pagination>
        <footer class="modal-footer">
        </footer>

    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        props: ['show', 'travel_id', 'recipient_id', 'auth_user', 'travel_user_name'],
        data() {
            return {
                content: '',
                messages: {},
            }
        },
        name: "MessageModal",
        components: {Modal},
        mounted() {

            this.getMessages();
        },
        methods: {

            close: function () {
                this.$emit('close')
            },
            getMessages: function (page = 1) {
                let params = {
                    page: page,
                };
                axios.get('/api/messages/' + this.recipient_id, {params})
                    .then(response => {
                        if (response.data) {
                            this.messages = response.data;
                        } else {
                            this.messages = '';
                        }
                    })
                    .catch()
            },
            sendTo() {
                axios.post('/api/messages', {
                    message: this.content,
                    travel_id: this.travel_id,
                    recipient_id: this.recipient_id,
                    sender_id: this.auth_user.id
                }).then(response => {
                    var mes = {};
                    mes.messages_latest = [];
                    mes.messages_latest.push({
                        'user_id': this.auth_user.id,
                        'body': this.content
                    });
                    this.messages.data.unshift(mes);
                    this.content = '';
                    if (!response.data.error) {
                        this.content = '';
                    }
                });
            }

        }
    }
</script>

<style scoped>
    .list-message {
        overflow-y: auto;
        height: 50%;
    }
</style>

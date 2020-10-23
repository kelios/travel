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
            <message-send v-bind:messagesBetween="messages" :recipient_id="recipient_id"></message-send>
        </section>
        <pagination :data="messages" :limit="4" align="center" @pagination-change-page="getMessages"></pagination>
        <div class="list-message">
            <div class="modal-content ">
                <div v-if="messages.data" class="col-md-12 col-sm-12" v-for="mes in messages.data">
                    <div v-if="mes.user_id == auth_user.id" class="alert alert-primary text-right">
                        {{mes.body}}
                    </div>
                    <div v-if="mes.user_id != auth_user.id" class="alert alert-dark text-left ">
                        {{mes.body}}
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
    import MessageSend from "./MessageSend";

    export default {
        props: ['show', 'travel_id', 'recipient_id', 'auth_user', 'travel_user_name'],
        data() {
            return {
                messages: {},
            }
        },
        name: "MessageModal",
        components: {MessageSend, Modal},
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


        }
    }
</script>

<style scoped>
    .list-message {
        overflow-y: auto;
        height: 50%;
    }
</style>

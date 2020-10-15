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
        <footer class="modal-footer">
        </footer>
    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        props: ['show', 'travel_id', 'recipient_id', 'auth_user','travel_user_name'],
        data() {
            return {
                content: ''
            }
        },
        name: "MessageModal",
        components: {Modal},
        mounted() {

        },
        methods: {

            close: function () {
                this.$emit('close')
            },
            sendTo() {
                axios.post('/api/messages', {
                    messages: this.content,
                    travel_id: this.travel_id,
                    recipient_id: this.recipient_id,
                    sender_id: this.auth_user.id
                }).then(response => {
                    this.content = '';
                    if (!response.data.error) {
                        this.content = '';
                        //this.$store.dispatch('GET_TRAVEL_COMMENTS', {'where': this.where});
                    }
                });
            }

        }
    }
</script>

<style scoped>

</style>

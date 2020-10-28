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
            <message-send :recipient_id="recipient_id"></message-send>
        </section>
        <message-between-list :recipient_id="recipient_id"></message-between-list>
        <footer class="modal-footer">
        </footer>

    </modal>
</template>

<script>
    import Modal from './Modal'
    import MessageSend from "./MessageSend";

    export default {
        props: ['show', 'travel_id', 'recipient_id', 'travel_user_name'],
        data() {
            return {
                where: []
            }
        },
        name: "MessageModal",
        components: {MessageSend, Modal},
        methods: {

            close: function () {
                this.$emit('close')
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

<template>
    <div class="col-md">
        <i :title="translate('travels.sendMessage')" @click.prevent="toggleModal(travel_id)"
           class="fa fa-envelope"
           aria-hidden="true"></i>
        <message-modal
            :show="showModal(travel_id)"
            :auth_user="auth_user"
            :recipient_id="recipient_id"
            :travel_id="travel_id"
            :travel_user_name="travel_user_name"
            @close="toggleModal(travel_id)"/>
    </div>
</template>

<script>

    export default {
        name: "MessageComponent",
        props: ['travel_id', 'recipient_id', 'auth_user', 'travel_user_name'],
        data() {
            return {
                activeModal: 0,
            }
        },
        mounted() {

        },
        methods: {
            showModal: function (id) {
                return this.activeModal === id
            },
            toggleModal: function (id) {
                if (this.activeModal !== 0) {
                    this.activeModal = 0
                    return false
                }
                this.activeModal = id
            },
        },
    }
</script>

<style scoped>

</style>

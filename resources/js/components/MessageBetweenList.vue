<template>
    <div>
        <pagination :data="messagesBetween" :limit="4" align="center"
                    @pagination-change-page="getMessages"></pagination>
        <div v-if="messagesBetween.data" v-for="mes in messagesBetween.data">
            <div v-if="mes.user_id == authUserId" class="alert alert-primary text-right">
                {{mes.body}}
            </div>
            <div v-if="mes.user_id != authUserId" class="alert alert-dark text-left ">
                {{mes.body}}
            </div>
        </div>

        <pagination :data="messagesBetween" :limit="4" align="center"
                    @pagination-change-page="getMessages"></pagination>

    </div>
</template>

<script>

    import {mapGetters} from "vuex";
    import $ from 'jquery'
    export default {
        name: "MessageBetweenList",
        props: ['recipient_id'],
        data() {
            return {
                where: []
            }
        },
        http: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        mounted() {
            this.getMessages();
        },
        watch: {
            recipient_id: function (newId, oldId) {
                if (newId != oldId) {
                    this.getMessages();
                }

            }
        },
        computed: {
            getRecipientId: function () {

            },

            ...mapGetters([
                'messagesBetween'
            ]),

        },
        methods: {
            getMessages: function (page = 1) {
                let params = {
                    page: page,
                };
                this.where['id'] = this.recipient_id;
                this.$store.dispatch('GET_MESSAGES_BETWEEN', {'page': page, 'where': this.where});

            },
        },
    }
</script>

<style scoped>

</style>

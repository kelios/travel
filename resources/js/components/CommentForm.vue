<template>
    <div class="comment-form">
        <div class="comment-avatar">
            <img :src="authUserAvatar">
        </div>
        <div class="form">
            <div class="form-row">
                    <textarea type="text" class="form-control"
                              v-model="content"
                              :placeholder="translate('travels.addcomment')"
                    ></textarea>
            </div>
            <div class="form-row">
                <input class="input" placeholder="Name" type="text" disabled :value="authUserName">
            </div>
            <div class="form-row">
                <input type="button" class="btn btn-success"
                       v-on:click="replyTo(comment)"
                       :value="translate('travels.addcomment')">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentForm",
        props: ['comment', 'where'],
        data() {
            return {
                content: ''
            }
        },
        methods: {
            replyTo(comment) {
                axios.post('/comments', {
                    comment: this.content,
                    travel_id: comment.travel_id,
                    reply_id: comment.id,
                    users_id: this.authUserId
                }).then(response => {
                    this.content = '';
                    if (!response.data.error) {
                        this.content = '';
                        this.$store.dispatch('GET_TRAVEL_COMMENTS', {'where': this.where});
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>

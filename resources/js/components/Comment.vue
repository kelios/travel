<template>
    <div class="comment">
        <div class="comment-avatar">
            <img lazy="loading" :src="comment.user.user_avatar_thumb_url">
        </div>
        <div class="comment-box">
            <div class="comment-text" v-html="comment.comment"></div>
            <div class="comment-footer">
                <div class="comment-info">
                       <span class="comment-author">
                               <em>{{ comment.user.name}}</em>
                           </span>
                    <span class="comment-date">{{ comment.created_at}}</span>
                </div>
                <a v-if="authUserId" @click="replyToComment = comment">{{translate('travels.reply')}}</a>
                <comment-form :where="where" v-if="replyToComment == comment"
                              :comment="comment"></comment-form>
                <comment-list v-if="collection[comment.id]" v-bind:comments="collection[comment.id]"
                              v-bind:collection="collection"></comment-list>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentForm from './CommentForm.vue';

    export default {
        props: ['comment', 'collection', 'where'],
        name: "Comment",
        data() {
            return {
                replyToComment: false
            }
        },
        mounted() {
        },
        components: {
            'comment-form': CommentForm
        }
    }
</script>

<style scoped>

</style>

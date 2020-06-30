<template>
    <div class="comment">
        <div class="comment-avatar">
            <img :src="comment.user.user_avatar_thumb_url">
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
                <a v-if="auth_user" @click="replyToComment = comment">{{__('travels.reply')}}</a>
                <comment-form :where="where" :auth_user="auth_user" v-if="replyToComment == comment"
                              :comment="comment"></comment-form>
                <comment-list :auth_user="auth_user" v-if="collection[comment.id]" v-bind:comments="collection[comment.id]"
                              v-bind:collection="collection"></comment-list>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentList from './CommentList.vue';
    import CommentForm from './CommentForm.vue';

    export default {
        props: ['comment', 'collection', 'auth_user', 'where'],
        name: "Comment",
        data() {
            return {
                replyToComment: false
            }
        },
        mounted() {
        },
        components: {
            'comment-list': CommentList,
            'comment-form': CommentForm
        }
    }
</script>

<style scoped>

</style>

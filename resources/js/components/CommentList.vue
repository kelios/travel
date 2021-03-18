<template>
    <div class="comments">
        <comment v-for="comment in comments"
                 v-bind:comment="comment"
                 v-bind:collection="collection"
                 v-bind:key="comment.id"
                 :where="where"
        ></comment>
    </div>
</template>

<script>

    import Comment from './Comment.vue';

    export default {
        name: "CommentList",
        props: ['collection', 'comments', 'where'],
        computed: {},
        components: {
            'comment': Comment,
        }
    }
</script>

<style scoped>

</style>

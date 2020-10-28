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
    export default {
        name: "CommentList",
        props: ['collection', 'comments', 'where'],
        computed: {},
    }
</script>

<style scoped>

</style>

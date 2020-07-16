<template>
    <div class="card-body">
        <div class="input-group mb-3">
            <img
                :src="friend.user_avatar_thumb_url"
                class="avatar-photo" :alt="friend.name">
            <span class="form-control">{{ friend.name }}</span>

            <div v-if="isAccept" class="input-group-append">
                <button type="button" class="btn btn-primary">{{__('user.acceptFriend')}}</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FriendCard",
        props: ['friend', 'isAccept'],
        mounted() {
            console.log(this.friend);
        },
    }
</script>

<style scoped>

</style>

<template>
    <div class="card-body">
        <div class="input-group mb-3">

            <img
                :src="friend.user_avatar_thumb_url"
                class="avatar-photo" :alt="friend.name">
            <span class="form-control-plaintext">{{ friend.name }}</span>

            <div v-if="isAccept" class="input-group-append">
                <button v-on:click="acceptFriendRequest(friend.id)" type="button" class="btn btn-primary">
                    {{translate('user.acceptFriend')}}
                </button>
                <button v-on:click="denyFriendRequest(friend.id)" type="button" class="btn btn-primary">
                    {{translate('user.denyFriendRequest')}}
                </button>
            </div>

            <div v-if="isRemove" class="input-group-append">
                <button v-on:click="unfriend(friend.id)" type="button" class="btn btn-primary">
                    {{translate('user.unfriend')}}
                </button>
            </div>
        </div>

        <div class="form-group row">
            <a :href="'/travels?user_id='+friend.id" target="_blank">
                {{translate('user.alltravel')}}{{ friend.name }} >
            </a>
        </div>

    </div>
</template>

<script>
    export default {
        name: "FriendCard",
        props: ['friend', 'isAccept', 'isRemove'],
        mounted() {

        },
        methods: {
            async  acceptFriendRequest(id) {
                let vm = this;
                axios.post('/api/acceptFriendRequest', {
                    friend_id: this.friend.id
                })
                    .then(response => {
                        vm.$emit('remove', id);
                    })
                    .catch()
            },
            denyFriendRequest(id) {
                let vm = this;

                axios.post('/api/denyFriendRequest', {
                    friend_id: this.friend.id
                })
                    .then(response => {
                        vm.$emit('remove', id);
                    })
                    .catch()
            },
            unfriend(id) {
                let vm = this;
                axios.post('/api/unfriend', {
                    friend_id: id
                })
                    .then(response => {
                        vm.$emit('remove', id);
                    })
                    .catch()
            }
        },
    }
</script>

<style scoped>

</style>

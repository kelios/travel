<template>
    <div v-if="isShow">
        +<i :title="labelActionFriend" @click.prevent="sendReqFriend" class="icon-user" aria-hidden="true"></i>
    </div>
</template>

<script>
    export default {
        name: "AddFriend",
        props: ['travel'],
        data() {
            return {
                labelActionFriend: 'Добавить в друзья',
                isShow: true,
            }
        },
        mounted() {

        },
        methods: {
            sendReqFriend() {
                axios.post('/api/sendreqfriends', {
                    friend_id: this.travel.users[0].id
                })
                    .then(response => {
                        this.isShow = false;
                        /*  if (response.data.count > 0) {
                              this.totallike++;
                              this.labelActionFriend = 'Убрать понравилось';

                          } else {
                              this.totallike--;
                              this.labelActionFriend = 'Понравилось';
                          }*/
                    })
                    .catch()
            },

        },
    }
</script>

<style scoped>

</style>

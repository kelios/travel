<template>
    <div class="col">
        <i :title="labelLike" @click.prevent="likePost" class="fa fa-thumbs-up" aria-hidden="true"></i>
        ({{ totallike }})
    </div>
</template>

<script>
    export default {
        name: "LikeComponent",
        props: ['travel'],
        data() {
            return {
                totallike: this.travel.totalLikes ?? 0,
                labelLike: ''
            }
        },
        mounted() {
            this.isLikedByMe();
        },
        methods: {
            isLikedByMe() {
                axios.post('/like/' + this.travel.id + '/islikedbyme')
                    .then(response => {
                        if (response.data.res) {
                            this.labelLike = 'Понравилось';
                        } else {
                            this.labelLike = 'Убрать понравилось';
                        }
                    })
                    .catch()
            },
            likePost() {
                axios.post('/like/' + this.travel.id)
                    .then(response => {
                        if (response.data.count > 0) {
                            this.totallike++;
                            this.labelLike = 'Убрать понравилось';

                        } else {
                            this.totallike--;
                            this.labelLike = 'Понравилось';
                        }
                    })
                    .catch()
            },

        },
    }
</script>

<style scoped>

</style>

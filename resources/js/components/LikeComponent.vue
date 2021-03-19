<template>
    <div class="col-md">
        <i :title="labelLike" @click.prevent="likePost" class="fa fa-thumbs-up" aria-hidden="true"></i>
        ({{ totallike }})
    </div>
</template>

<script>
    export default {
        name: "LikeComponent",
        props: ['travel_id', 'total_likes'],
        data() {
            return {
                totallike: this.total_likes ?? 0,
                labelLike: ''
            }
        },
        mounted() {
            this.isLikedByMe();
        },
        methods: {
            async isLikedByMe() {
                 axios.get('/like/' + this.travel_id + '/islikedbyme')
                    .then(response => {
                        if (response.data.res) {
                            this.labelLike = 'Понравилось';
                        } else {
                            this.labelLike = 'Убрать понравилось';
                        }
                    })
                    .catch()
            },
            async likePost() {
                axios.post('/like/' + this.travel_id)
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

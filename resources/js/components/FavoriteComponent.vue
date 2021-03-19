<template>
    <div class="col-md">
        <i :title="labelFavorite" @click.prevent="savePost" class="fa fa-save" aria-hidden="true"></i>
    </div>
</template>

<script>
    export default {
        name: "FavoriteComponent",
        props: ['travel_id'],
        data() {
            return {
                labelFavorite: ''
            }
        },
        mounted() {
            this.isFavoritedByMe();
        },
        methods: {
            async isFavoritedByMe() {
                 axios.get('/save/' + this.travel_id + '/isfavoritedbyme')
                    .then(response => {
                        if (response.data.res) {
                            this.labelFavorite = 'Сохранить маршрут';
                        } else {
                            this.labelFavorite = 'Удалить из маршрутов';
                        }
                    })
                    .catch()
            },
            savePost() {
                axios.post('/save/' + this.travel_id)
                    .then(response => {
                        if (response.data.count > 0) {
                            this.labelFavorite = 'Удалить из маршрутов';

                        } else {
                            this.labelFavorite = 'Сохранить маршрут';
                        }
                    })
                    .catch()
            },

        },
    }
</script>

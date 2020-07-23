<template>
    <div class="col">
        <i :title="labelFavorite" @click.prevent="savePost" class="fa fa-save" aria-hidden="true"></i>
    </div>
</template>

<script>
    export default {
        name: "FavoriteComponent",
        props: ['travel'],
        data() {
            return {
                labelFavorite: ''
            }
        },
        mounted() {
            this.isFavoritedByMe();
        },
        methods: {
            isFavoritedByMe() {
                axios.post('/save/' + this.travel.id + '/isfavoritedbyme')
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
                axios.post('/save/' + this.travel.id)
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

<style scoped>

</style>

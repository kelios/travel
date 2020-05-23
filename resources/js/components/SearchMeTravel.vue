<template>
    <div class="container">
        <div class="input-group mb-3">
            <input v-model="query" type="text" class="form-control" :placeholder="trans('main.TravelPlaceholder')"
                   aria-label="Travel title or description"
                   aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                    {{ trans('main.search')}}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchMeTravel",
        props: ['travels'],
        data: function () {
            return {
                query: '',
            }
        },
        watch: {
            query: {
                handler: _.debounce(function () {
                    this.searchTravels()
                }, 100)
            }
        },
        methods: {
            searchTravels() {
                this.$store.dispatch('SEARCH_TRAVELS', this.query)
            }
        }

    }
</script>

<style scoped>

</style>

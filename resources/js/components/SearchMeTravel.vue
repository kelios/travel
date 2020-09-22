<template>
    <div class="container">
        <div class="input-group mb-3">
            <input v-model="query" type="text" class="form-control" :placeholder="translate('main.TravelPlaceholder')"
                   aria-label="Travel title or description"
                   aria-describedby="basic-addon2">
            <div class="input-group-append">
               <!-- <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                    {{translate('main.search')}}
                </button>
                -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchMeTravel",
        props: ['travels','where'],
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
                this.$store.dispatch('SEARCH_TRAVELS', {'query':this.query,'where':this.where})
            }
        }

    }
</script>

<style scoped>

</style>

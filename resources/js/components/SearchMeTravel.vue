<template>
    <div class="container">
        <div class="input-group mb-3">
            <input v-model="query" type="text" class="form-control" :placeholder="__('main.TravelPlaceholder')"
                   aria-label="Travel title or description"
                   aria-describedby="basic-addon2">
            <div class="input-group-append">
                <!-- <button class="btn btn-primary" @click="searchTravels" @keyup.enter="searchTravels" type="button">
                     {{__('main.search')}}
                 </button>
                 -->
            </div>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash'
    import {mapGetters} from "vuex";

    export default {
        name: "SearchMeTravel",
        props: ['travels', 'where'],
        data: function () {
            return {
                query: '',
            }
        },
        computed: {
            ...mapGetters([
                'perPage'
            ])
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
                this.$store.commit('SET_QUERY', this.query)
                this.$store.dispatch('SEARCH_TRAVELS', {
                    'query': this.query,
                    'perPage': this.perPage,
                    'where': this.where
                })
            }
        }

    }
</script>

<style scoped>

</style>

<template>
    <div class="travel-section-content">
        <h2 class="mb-5">{{title}}</h2>
        <p class="lead mb-0" v-html="getData"></p>
    </div>
</template>

<script>

    export default {
        name: 'TravelShowSection',
        props: ['data', 'title'],
        computed: {
            getData() {
                if (Array.isArray(this.data)) {
                    return this.data.join(',');
                } else {
                    return this.data;
                }
            }

        },
        methods: {},
    }
</script>

<style scoped>

</style>

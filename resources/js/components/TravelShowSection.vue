<template>
    <div class="treavel-section-content">
        <h1 class="mb-0">{{title}}</h1>
        <p class="lead mb-5" v-html="getData"></p>
    </div>
</template>

<script>

    export default {
        name: 'TravelShowSection',
        props: ['data', 'title'],
        created() {
            console.log('mounted');
            console.log(this.data);
        },
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

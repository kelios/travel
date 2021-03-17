<template>
    <div>
        <multiselect
            :options="listPerPage"
            :multiple="false"
            :value="currentPerPage"
            selectLabel=""
            @select="setPerPage"
            deselect-label=''
        >
        </multiselect>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import {mapGetters} from "vuex";

    export default {
        name: "SelectPerPage",
        data() {
            return {
                listPerPage: [
                    6,
                    12,
                    24,
                    36,
                    72,
                ],
            }
        },
        computed: {
            currentPerPage() {
                return this.perPage;
            },
            ...mapGetters([
                'perPage'
            ])
        },
        methods: {
            setPerPage: function (count) {
                this.$store.commit('SET_PERPAGE', count);
                this.$emit("getRes");
            }
        },
        components: {Multiselect}

    }
</script>

<style>
    .multiselect__tags {
        min-height: 32px;
        display: block;
        padding: 3px 40px 0 8px;
        border-radius: 5px;
        border: 1px solid #e8e8e8;
        background: #fff;
        font-size: 14px;

    }

    .multiselect__input, .multiselect__single {
        border-top-right-radius: 0.2rem;
        border-bottom-right-radius: 0.2rem;
    }
</style>

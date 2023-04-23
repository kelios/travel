<template>
    <div>
        <Multiselect
            :options="listPerPage"
            mode="single"
            :value ="currentPerPage"
            @select="setPerPage"
        >
        </Multiselect>
    </div>
</template>
<script>
export default {
    name: "SelectPerPage",
};
</script>
<script setup>
import Multiselect from "@vueform/multiselect";
import {computed} from "vue";
import {useStore} from "vuex";

console.log('SelectPerPage');
const store = useStore()
const listPerPage = [
    20,
    40,
    60,
    80,
    100,
]
let perPage = 20;

const currentPerPage = computed(() => {
    return perPage;
});

perPage = computed(() => {
    return store.getters.perPage;
});

const emit = defineEmits()
function setPerPage(count) {
    store.commit('SET_PERPAGE', count);
    emit("getRes");
}


</script>

<style scope>
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
<style lang="scss" scoped>
@import "@vueform/multiselect/themes/default.css";
</style>

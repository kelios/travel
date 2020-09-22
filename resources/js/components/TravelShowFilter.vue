<template>
    <div id="page-top">
        <div class="tab-content showTravel" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-categories" role="tabpanel"
                 aria-labelledby="nav-categories-tab">
                {{ travel.categoryName }}
            </div>

            <div class="tab-pane fade" id="pills-complexity" role="tabpanel" aria-labelledby="pills-complexity-tab">
                {{ travel.complexityName }}
            </div>
            <div class="tab-pane fade" id="pills-transport" role="tabpanel" aria-labelledby="pills-transport-tab">
                {{ travel.transportName }}
            </div>
            <div class="tab-pane fade" id="pills-overNightStay" role="tabpanel"
                 aria-labelledby="pills-overNightStay-tab">
                {{ travel.overNightStayName }}
            </div>
            <div class="tab-pane fade" id="pills-budget" role="tabpanel" aria-labelledby="pills-budget-tab">
                {{ travel.budget }}
            </div>
            <div class="tab-pane fade" id="pills-number_peoples" role="tabpanel"
                 aria-labelledby="pills-number_peoples-tab">
                {{ travel.number_peoples }}
            </div>
        </div>
        <div class="navbar fixed-right">
            <ul class="nav nav-pills mb-3 navleft" id="pills-tab" role="tablist">
                <li class="nav-item" v-if="travel.categoryName">
                    <a class="nav-link" id="pills-categories-tab"
                       data-toggle="pill" href="#pills-categories" role="tab" aria-controls="pills-home"
                       aria-selected="false">
                        {{ translate('travels.categories') }}</a>
                </li>

                <li class="nav-item" v-if="travel.complexityName">
                    <a class=" nav-link" id="pills-complexity-tab"
                       data-toggle="pill" href="#pills-complexity" role="tab" aria-controls="pills-complexity"
                       aria-selected="false">
                        {{ translate('travels.complexity') }}</a>
                </li>

                <li class="nav-item" v-if="travel.transportName">
                    <a class=" nav-link" id="pills-transport-tab"
                       data-toggle="pill" href="#pills-transport" role="tab" aria-controls="pills-transport"
                       aria-selected="false">
                        {{ translate('travels.transports') }}</a>
                </li>

                <li class="nav-item" v-if="travel.overNightStay">
                    <a class=" nav-link" id="pills-overNightStay-tab"
                       data-toggle="pill" href="#pills-overNightStay" role="tab" aria-controls="pills-overNightStay"
                       aria-selected="true">
                        {{ translate('travels.overNightStay') }}</a>
                </li>

                <li class="nav-item" v-if="travel.budget">
                    <a class=" nav-link" id="pills-budget-tab"
                       data-toggle="pill" href="#pills-budget" role="tab" aria-controls="pills-budget"
                       aria-selected="false">
                        {{ translate('travels.budget') }}</a>
                </li>

                <li class="nav-item" v-if="travel.number_peoples">
                    <a class=" nav-link" id="pills-number_peoples-tab"
                       data-toggle="pill" href="#pills-number_peoples" role="tab" aria-controls="pills-number_peoples"
                       aria-selected="false">
                        {{ translate('travels.number_peoples') }}</a>
                </li>


            </ul>
        </div>

    </div>
</template>

<script>
    export default {
        name: "TravelShowFilter",
        props: ['travel'],

    }
</script>

<style scoped>

</style>

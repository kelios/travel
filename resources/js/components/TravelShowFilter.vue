<template>
    <div>
        <div class="navbar fixed-right bg-white fixed-top-2">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" v-if="travel.categoryName">
                    <a class="nav-link" id="pills-categories-tab"
                       data-toggle="pill" href="#pills-categories" role="tab" aria-controls="pills-home"
                       aria-selected="false">
                        {{ trans('travels.categories') }}</a>
                </li>

                <li class="nav-item" v-if="travel.complexityName">
                    <a class=" nav-link" id="pills-complexity-tab"
                       data-toggle="pill" href="#pills-complexity" role="tab" aria-controls="pills-complexity"
                       aria-selected="false">
                        {{ trans('travels.complexity') }}</a>
                </li>

                <li class="nav-item" v-if="travel.transportName">
                    <a class=" nav-link" id="pills-transport-tab"
                       data-toggle="pill" href="#pills-transport" role="tab" aria-controls="pills-transport"
                       aria-selected="false">
                        {{ trans('travels.transports') }}</a>
                </li>

                <li class="nav-item" v-if="travel.overNightStay">
                    <a class=" nav-link" id="pills-overNightStay-tab"
                       data-toggle="pill" href="#pills-overNightStay" role="tab" aria-controls="pills-overNightStay"
                       aria-selected="true">
                        {{ trans('travels.overNightStay') }}</a>
                </li>

                <li class="nav-item" v-if="travel.budget">
                    <a class=" nav-link" id="pills-budget-tab"
                       data-toggle="pill" href="#pills-budget" role="tab" aria-controls="pills-budget"
                       aria-selected="false">
                        {{ trans('travels.budget') }}</a>
                </li>

                <li class="nav-item" v-if="travel.number_peoples">
                    <a class=" nav-link" id="pills-number_peoples-tab"
                       data-toggle="pill" href="#pills-number_peoples" role="tab" aria-controls="pills-number_peoples"
                       aria-selected="false">
                        {{ trans('travels.number_peoples') }}</a>
                </li>

                <li class="nav-item" v-if="travel.number_days">
                    <a class="nav-link" id="pills-number_days-tab"
                       data-toggle="pill" href="#pills-number_days" role="tab" aria-controls="pills-number_peoples"
                       aria-selected="false">
                        {{ trans('travels.number_days') }}</a>
                </li>
            </ul>
        </div>

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
            <div class="tab-pane fade" id="pills-number_days" role="tabpanel" aria-labelledby="pills-number_days-tab">
                {{ travel.number_days }}
            </div>
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

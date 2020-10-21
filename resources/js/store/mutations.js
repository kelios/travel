let mutations = {
    SET_TRAVELS(state, travels) {
        state.travels = travels
    },
    SET_COMMENTS(state, comments) {
        state.travelComments = comments
    },
    SET_LAST_TRAVELS(state, travels) {
        state.lastTravels = travels
    },
    SET_OPTIONS_CITIES(state, optionsCities) {
        state.optionsCities = optionsCities
    },
    SET_MAP_DATA(state, travels) {
        state.travelAddress.meCoord = [];
        travels.data.forEach((travel, indexMe) => {
            state.travelAddress.address.push(travel.travelAddressAdress);
            state.travelAddress.meCoord.push(travel.coordsMeTravelArr);
            state.travelAddress.url.push(travel.url);
        })
    },
    UPDATE_COMMENTS(state, payLoad) {
        state.travelComments.push(payLoad['comments']);
    },
    SET_FRIENDS(state, friends) {
        state.friends = friends
    },
    SET_MESSAGES(state, messages) {
        state.messages = messages
    },
    SET_WHERE(state, where) {
        state.where = where
    },
    SET_QUERY(state, query) {
        state.query = query
    },
    SET_TRAVEL(state, travel) {
        state.travel = travel
    },
    SET_FILTER_TRAVEL(state, filtersTravel) {
        state.filtersTravel = filtersTravel
    },

}

export default mutations

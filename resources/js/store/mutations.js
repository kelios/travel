let mutations = {
    SET_TRAVELS(state, travels) {
        state.travels = travels
    },
    SET_LAST_TRAVELS(state, travels) {
        state.lastTravels = travels
    },
    SET_OPTIONS_CITIES(state, optionsCities) {
        state.optionsCities = optionsCities
    },
    SET_MAP_DATA(state, travels) {
        travels.data.forEach((travel) => {
            state.travelAddress.address.push(travel.travelAddressAdress);
            let arraycoordMeTravel = [];
            travel.coordMeTravel.forEach((coords) => {
                arraycoordMeTravel = coords.split(',');
                state.travelAddress.meCoord.push({'lat': arraycoordMeTravel[0], 'lng': arraycoordMeTravel[1]});
            })
            state.travelAddress.url.push(travel.url);
        })
    }
}

export default mutations

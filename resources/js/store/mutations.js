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
        state.travelAddress.meCoord = [];
        travels.data.forEach((travel, indexMe) => {
            state.travelAddress.address.push(travel.travelAddressAdress);
            state.travelAddress.meCoord.push(travel.coordsMeTravelArr);
          /*  let arraycoordMeTravel = [];
            state.travelAddress.meCoord.forEach((coords) => {
                console.log(indexMe);
                arraycoordMeTravel = coords.split(',');
                state.travelAddress.meCoord.push({'lat': arraycoordMeTravel[0], 'lng': arraycoordMeTravel[1]});
            });*/
            state.travelAddress.url.push(travel.url);
        })
    }
}

export default mutations

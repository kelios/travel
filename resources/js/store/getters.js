let getters = {
    travels: state => {
        return state.travels
    },
    travelComments: state => {
        return state.travelComments
    },
    lastTravels: state => {
        return state.lastTravels
    },
    travelAddress: state => {
        return state.travelAddress
    },
    optionsCities: state => {
        return state.optionsCities
    },
    friends: state => {
        return state.friends
    },
}

export default getters

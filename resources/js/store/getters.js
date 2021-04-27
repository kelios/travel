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
    messages: state => {
        return state.messages
    },
    where: state => {
        return state.where
    },
    query: state => {
        return state.query
    },
    travel: state => {
        return state.travel
    },
    filtersTravel: state => {
        return state.filtersTravel
    },
    messagesBetween: state => {
        return state.messagesBetween
    },
    usersMessages: state => {
        return state.usersMessages
    },
    travelId: state => {
        return state.travelId
    },
    travelAddressIds: state => {
        return state.travelAddressIds
    },
    perPage: state => {
        return state.perPage
    },
    popularTravels: state => {
        return state.popularTravels
    },
    nearTravels: state => {
        return state.nearTravels
    },
    lat: state => {
        return state.lat
    },
    lng: state => {
        return state.lng
    },
}

export default getters

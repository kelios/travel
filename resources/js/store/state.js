let state = {
    travels: {},
    travel: {},
    where: [],
    query: '',
    filtersTravel: [],
    lastTravels: {},
    popularTravels: {},
    nearTravels: {},
    travelAddressArr: [],
    submitingForm:false,
    travelAddress: {
        'address': [],
        'meCoord': [],
        'city': [],
        'country': [],
        'url': []
    },
    travelComments: [],
    optionsCities: [],
    defImageTravel: '/media/metravel.jpg',
    friends: {},
    messages: {},
    messagesBetween: {data: {}},
    usersMessages: {},
    messagesBetweenNew: {},
    travelId: '',
    travelAddressIds: [],
    perPage: 20,
    lat: 50.5403576,
    lng: 19.3672883
}
export default state

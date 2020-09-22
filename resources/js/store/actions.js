let actions = {
    SEARCH_TRAVELS({commit}, data) {
        let params = {
            query: data.query,
            where: data.where,
        };
        axios.get(`/api/search`, {params})
            .then(res => {
                if (res.data === 'ok')
                    console.log('request sent successfully')

            }).catch(err => {
            console.log(err)
        })
    },
    SEARCH_EXTENDED_TRAVELS({commit}, data) {
        let params = {
            query: data.query,
            where: data.where,
        };
        axios.get(`/api/searchextended`, {params})
            .then(res => {
                if (res.data === 'ok')
                    console.log('request sent successfully')

            }).catch(err => {
            console.log(err)
        })
    },
    SEARCH_CITIES({commit}, data) {
        let params = {
            query: data.query,
            countryIds: data.countryIds,
        };
        axios.get(`/api/searchCities`, {params})
            .then(res => {
                if (res.data === 'ok')
                    console.log('request sent successfully')

            }).catch(err => {
            console.log(err)
        })
    },
    GET_TRAVELS({commit}, data) {
        let params = {
            page: data.page,
            where: data.where,
        };
        axios.get('/api/travels', {params})
            .then(res => {
                {
                    commit('SET_TRAVELS', res.data);
                    commit('SET_MAP_DATA', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
    GET_LAST_TRAVELS({commit}, data) {
        axios.get('/api/travelsLast')
            .then(res => {
                {
                    commit('SET_LAST_TRAVELS', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
    GET_TRAVEL_COMMENTS({commit}, data) {
        let params = {
            where: data.where,
        };
        axios.get('/api/travelComments', {params})
            .then(res => {
                {
                    commit('SET_COMMENTS', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
    GET_FRIENDS({commit}, data) {
        let params = {
            page: data.page,
            where: data.where,
        };
        axios.get('/api/friends', {params})
            .then(res => {
                {
                    commit('SET_FRIENDS', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
    GET_TRAVEL({commit}, data) {
        let params = {
            id: data.travel_id,
        };
        axios.get('/api/travel', {params})
            .then(res => {
                {
                    commit('SET_TRAVEL', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
}

export default actions

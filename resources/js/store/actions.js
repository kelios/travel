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
    GET_MESSAGES({commit}, data) {
        let params = {
            page: data.page,
            where: data.where,
        };
        axios.get('/api/messages', {params})
            .then(res => {
                {
                    commit('SET_MESSAGES', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
    GET_MESSAGES_BETWEEN({commit}, data) {
        let params = {
            page: data.page,
        };
        axios.get('/api/messages/' + data.where['id'], {params})
            .then(res => {
                {
                    commit('SET_MESSAGES_BETWEEN', res.data);
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
    GET_FILTER_TRAVEL({commit}, data) {
        let params = {};
        axios.get('/api/getFiltersTravel', {params})
            .then(res => {
                {
                    commit('SET_FILTER_TRAVEL', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
    GET_USERS_MESSAGES({commit}, data) {
        let params = {
            page: data.page,
            where: data.where,
        };
        axios.get('/api/messagesUsers/', {params})
            .then(res => {
                {
                    commit('SET_USERS_MESSAGES', res.data);
                }
            })
            .catch(err => {
                console.log(err)
            })
    },
    AUTO_SAVE_TRAVEL({commit}, dataTravel) {
        axios.post('/api/travels/save', dataTravel
        ).then(response => {
            if (!response.data.error) {
                commit('SET_TRAVEL_ID', response.data.id);
            }
        });
    }
}

export default actions

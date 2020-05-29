let actions = {
    SEARCH_TRAVELS({commit}, data) {
        let params = {
            query: data.query,
            where:data.where,
        };
        axios.get(`/api/search`, {params})
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
            where:data.where,
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
    }
}

export default actions

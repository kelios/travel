import AppForm from '../app-components/Form/AppForm';

Vue.component('travel-form', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                name: '',
                categories: '',
                transports: '',
                month: '',
                complexity: '',
                overNightStay: '',
                cities: '',
                countries: '',
                budget: '',
                year: '',
                number_peoples: '',
                number_days: '',
                minus: '',
                plus: '',
                recommendation: '',
                description: '',
                publish: false,
                visa: false,

            }
        }
    },
    methods: {
        getCountries: function () {
            axios.get('/location/countries')
                .then(function (response) {
                    this.countries = response.data;
                }.bind(this));

        },
        getCities: function (items) {
            let selectedCounties = [];
            items.forEach((item) => {
                selectedCounties.push(item.id);
            });
            axios.get('/location/countriesCities', {
                params: {
                    country_id: selectedCounties
                }
            }).then(function (response) {
                this.cities = response.data;
                console.log(this.cities);
            }.bind(this));
        }
    },
    created: function () {
        this.getCountries()
    }

});

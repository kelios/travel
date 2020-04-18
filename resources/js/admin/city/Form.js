import AppForm from '../app-components/Form/AppForm';

Vue.component('city-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                state_id:  '' ,
                country_id:  '' ,
                
            }
        }
    }

});
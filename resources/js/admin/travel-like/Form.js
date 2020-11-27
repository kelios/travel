import AppForm from '../app-components/Form/AppForm';

Vue.component('travel-like-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                travel_id:  '' ,
                user_id:  '' ,
                
            }
        }
    }

});
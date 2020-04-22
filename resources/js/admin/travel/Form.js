import AppForm from '../app-components/Form/AppForm';

Vue.component('travel-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                budget:  '' ,
                year:  '' ,
                number_peoples:  '' ,
                number_days:  '' ,
                minus:  '' ,
                plus:  '' ,
                recommendation:  '' ,
                description:  '' ,
                publish:  false ,
                visa:  false ,

            }
        }
    }

});

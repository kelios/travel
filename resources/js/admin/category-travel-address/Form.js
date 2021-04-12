import AppForm from '../app-components/Form/AppForm';

Vue.component('category-travel-address-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                status:  false ,
                
            }
        }
    }

});
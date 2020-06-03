import AppForm from '../app-components/Form/AppForm';

Vue.component('companion-form', {
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
import AppForm from '../app-components/Form/AppForm';

Vue.component('over-night-stay-form', {
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
import AppForm from '../app-components/Form/AppForm';

Vue.component('message-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                messages:  '' ,
                travel_id:  '' ,
                sender_id:  '' ,
                recipient_id:  '' ,
                is_read:  false ,
                
            }
        }
    }

});
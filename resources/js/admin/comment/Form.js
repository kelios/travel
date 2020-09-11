import AppForm from '../app-components/Form/AppForm';

Vue.component('comment-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                comment:  '' ,
                travel_id:  '' ,
                users_id:  '' ,
                reply_id:  '' ,
                
            }
        }
    }

});
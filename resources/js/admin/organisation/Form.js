import AppForm from '../app-components/Form/AppForm';

Vue.component('organisation-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title:  '' ,
                
            }
        }
    }

});
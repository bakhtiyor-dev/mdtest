import AppForm from '../app-components/Form/AppForm';

Vue.component('test-category-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title:  ''
            }
        }
    }

});
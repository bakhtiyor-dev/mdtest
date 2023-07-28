import AppForm from '../app-components/Form/AppForm';

Vue.component('rating-setting-form', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                title: '',
                settings: undefined,
            }
        }
    }

});
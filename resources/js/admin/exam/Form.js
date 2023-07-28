import AppForm from '../app-components/Form/AppForm';

Vue.component('exam-form', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                attempts_count: '',
                can_complete_untill_all_answered: false,
                can_return_to_passed_question: false,
                can_skip_question: false,
                title: '',
                enable_explanation: false,
                end_date: '',
                start_date: '',
                test_category_count: '',
                time: '',
                rating_setting_id: '',
                department_id: '',
                organisation_id: ''
            }
        }
    }

});
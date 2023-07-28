import AppForm from '../app-components/Form/AppForm';
import AnswersForm from '../components/AnswerForms/AnswersForm';

Vue.component('test-form', {
    mixins: [AppForm],
    components: {AnswersForm},

    data: function () {
        return {
            form: {
                category_id: '',
                body: '',
                answers_type: '',
                answers: '',
                explanation: '',
                status: false
            }
        }
    },

    computed: {
        answerTypes() {
            return ANSWER_TYPES;
        }
    },

    created() {
        this.form.answers = {
            data: this.form.answers
        }
    }

});
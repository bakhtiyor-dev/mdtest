import ExamCheatPrevention from "./ExamCheatPrevention";
import ExamCompletion from "./ExamCompletion";
import ExamInteraction from "./ExamInteraction";
import ExamRestrictions from "./ExamRestrictions";

export default {
    mixins: [ExamCheatPrevention, ExamCompletion, ExamInteraction, ExamRestrictions],

    computed: {
        ANSWER_TYPE() {
            return ANSWER_TYPE;
        }
    },

    methods: {
        answered(solvedTest) {
            this.currentTest = solvedTest;
        }
    }
}
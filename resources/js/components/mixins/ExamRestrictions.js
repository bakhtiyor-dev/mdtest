export default {
    computed: {
        state() {
            return {
                disableNext: false,
                disablePrev: false,
                disableComplete: !this.config.can_complete_untill_all_answered
            }
        },

        config() {
            return {
                can_skip_question: (this.exam.can_skip_question || this.currentTest.hasOwnProperty('is_answered')),
                can_return_to_passed_question: this.exam.can_return_to_passed_question,
                can_complete_untill_all_answered: this.exam.can_complete_untill_all_answered || (this.notAnsweredCount === 0)
            }
        },

        notAnsweredCount() {
            return this.tests.filter((test) => {
                return test.is_answered === undefined;
            }).length
        }
    },

    watch: {
        currentIndex(index) {
            this.state.disablePrev = index === 0;
            this.state.disableNext = index === this.tests.length - 1;
        }
    }
}
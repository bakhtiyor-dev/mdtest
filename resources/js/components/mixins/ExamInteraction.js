export default {
    methods:{
        next() {
            if (this.currentIndex < this.tests.length - 1)
                this.toggle(this.currentIndex + 1)
        },

        prev() {
            if (this.currentIndex > 0)
                this.toggle(this.currentIndex - 1);
        },

        toggle(index) {
            if (this.config.can_skip_question) {

                if (this.tests[index].hasOwnProperty('is_answered') && !this.config.can_return_to_passed_question) {
                    this.$notify({
                        group: 'error',
                        type: 'warn',
                        text: '<b>Запрещено возврат к пройденным вопросам!</b> '
                    });
                    return
                }

                this.currentTest = this.tests[index];
                this.currentIndex = index;

            } else {
                this.$notify({
                    group: 'error',
                    type: 'warn',
                    text: '<b>Запрещено пропуск вопроса!</b> '
                });
            }
        },
    }
}
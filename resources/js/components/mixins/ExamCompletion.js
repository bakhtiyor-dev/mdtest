export default {
    watch: {
        finished(val) {
            if (val === true) {
                this.preventReload = false;
                this.check();
            }
        }
    },

    methods: {
        finish() {
            if (this.config.can_complete_untill_all_answered)
                (new bootstrap.Modal(document.getElementById('modal'))).show();
            else
                console.log('You cannot finish');
        },

        check() {
            this.preventClose = true;
            document.getElementById('form').submit();
        },

        sendData() {
            axios.post(this.url, {tests: JSON.stringify(this.tests)});
        }

    }
}
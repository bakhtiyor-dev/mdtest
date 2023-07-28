export default {
    created() {
        window.history.pushState("", "", '/exam/started');

        window.onbeforeunload = (e) => {
            if (this.preventReload) {
                e.preventDefault();
                e.returnValue = '';
            }
            this.sendData();
        }

        window.onunload = () => {
            this.preventReload = false;

            if (!this.preventClose) {
                window.close();
            }

        }
    }
}
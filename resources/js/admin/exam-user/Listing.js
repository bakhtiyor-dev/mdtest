import AppListing from '../app-components/Listing/AppListing';

Vue.component('exam-user-listing', {
    mixins: [AppListing],
    data() {
        return {
            loading: false
        }
    },
    methods: {

        bulkNotify(exam) {
            let self = this;
            this.confirmModal(() => {

                this.$modal.hide('dialog');

                this.$notify({
                    type: 'success',
                    title: '',
                    duration: 7000,
                    text: 'Электронные адреса пользователей поставлены в очередь для отправки письм. Письма будут отправлены в течении нескольких минут.'
                });

                axios.create().post(`/admin/exam-users/bulk-notify/${exam}`,
                    {bulkItems: this.bulkItems})
                    .then((response) => self.onFinish(response))
                    .catch((error)=>{
                        this.$notify({
                            type: 'error',
                            title: '',
                            duration: -1,
                            text: error.response.data.message
                        });
                    })


            });
        },

        confirmModal(handler) {
            this.$modal.show('dialog', {
                title: 'Предупреждение!',
                text: 'Электронное письмо об экзамене будет разослано почтовому ящику пользователя.',
                buttons: [
                    {title: 'Нет, отменить.'},
                    {
                        title: '<span class="btn-dialog btn-danger">Да, продолжить.<span>',
                        handler: handler
                    }
                ]
            });
        },

        onFinish(response) {

            if (response.data.success)
                this.$notify({
                    type: 'success',
                    title: 'Успех!',
                    text: 'Операция прошла успешно.'
                });
            else
                this.$notify({
                    type: 'error',
                    duration: -1,
                    title: 'Ошибка!',
                    text: response.data.error
                });

            this.loadData();
        }


    },

    computed: {
        deleteWarningText() {
            return 'Вы действительно хотите открепить пользователя с этого экзамена?'
        },

        bulkDeleteWarnignText() {
            return 'Вы действительно хотите открепить этих пользователей с экзамена?'
        }
    }
})
;
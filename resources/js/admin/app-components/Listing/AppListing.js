import {BaseListing} from 'craftable';
import _lodash from "lodash";

export default {
    mixins: [BaseListing],
    computed: {
        deleteWarningText() {
            return 'Вы действительно хотите удалить этот элемент?'
        },

        bulkDeleteWarnignText() {
            return 'Вы действительно хотите удалить ' + this.clickedBulkItemsCount + ' выбранных элементов?';
        }
    },

    beforeCreate() {
        this.$Progress.start();
    },

    created() {
        this.$Progress.finish();
    },

    methods: {
        deleteItem: function deleteItem(url) {
            let self = this;
            this.$modal.show('dialog', {
                title: 'Предупреждение!',
                text: this.deleteWarningText,
                buttons: [{title: 'Нет, отменить.'}, {
                    title: '<span class="btn-dialog btn-danger">Да, продолжать.<span>',
                    handler: function handler() {
                        self.$modal.hide('dialog');
                        axios.delete(url).then(function (response) {
                            self.loadData();
                        });
                    }
                }]
            });
        },

        bulkDelete: function bulkDelete(url) {

            let itemsToDelete = (0, _lodash.keys)((0, _lodash.pickBy)(this.bulkItems));
            let self = this;

            this.$modal.show('dialog', {
                title: 'Предупреждение!',
                text: this.bulkDeleteWarnignText,
                buttons: [{title: 'Нет, отменить.'}, {
                    title: '<span class="btn-dialog btn-danger">Да, продолжать.<span>',
                    handler: function handler() {
                        self.$modal.hide('dialog');
                        axios.post(url, {
                            data: {
                                'ids': itemsToDelete
                            }
                        }).then(function (response) {
                            self.bulkItems = {};
                            self.loadData();
                        });
                    }
                }]
            });
        },

    },

    filters: {
        html(value) {
            return value.replace(/(<([^>]+)>)/gi, "");
        }
    }
};
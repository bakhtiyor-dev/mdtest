import {BaseForm} from 'craftable';

export default {
    mixins: [BaseForm],
    data() {
        return {
            mediaWysiwygConfig: {
                lang: 'ru',
                autogrow: true,
                imageWidthModalEdit: true,
                btnsDef: {
                    image: {
                        dropdown: ['insertImage', 'upload'],
                        ico: 'insertImage'
                    },
                    align: {
                        dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ico: 'justifyLeft'
                    }
                },
                btns: [
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    //['superscript', 'subscript'],
                    ['align'],
                    ['unorderedList', 'orderedList', 'table'],
                    ['foreColor', 'backColor'],
                    ['link', 'image'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['template'],
                    ['fullscreen', 'viewHTML'],
                ],
            }
        }
    },

    methods: {
        onSubmit: function onSubmit() {
            var self = this;

            return this.$validator.validateAll().then(function (result) {
                if (!result) {
                    self.$notify({
                        type: 'error',
                        title: 'Ошибка!',
                        text: 'Форма содержит недопустимые поля.'
                    });
                    return false;
                }

                var data = self.form;
                if (!self.sendEmptyLocales) {
                    data = _.omit(self.form, self.locales.filter(function (locale) {
                        return _.isEmpty(self.form[locale]);
                    }));
                }

                self.submiting = true;

                axios.post(self.action, self.getPostData()).then(function (response) {
                    return self.onSuccess(response.data);
                }).catch(function (errors) {
                    return self.onFail(errors.response.data);
                });
            });
        },

        onFail: function onFail(data) {
            this.submiting = false;
            if (typeof(data.errors) !== (typeof undefined === 'undefined' ? 'undefined' : typeof(undefined))) {
                var bag = this.$validator.errors;
                bag.clear();
                Object.keys(data.errors).map(function (key) {
                    var splitted = key.split('.', 2);
                    // we assume that first dot divides column and locale (TODO maybe refactor this and make it more general)
                    if (splitted.length > 1) {
                        bag.add({
                            field: splitted[0] + '_' + splitted[1],
                            msg: data.errors[key][0]
                        });
                    } else {
                        bag.add({
                            field: key,
                            msg: data.errors[key][0]
                        });
                    }
                });
                if (typeof(data.message) === (typeof undefined === 'undefined' ? 'undefined' : typeof(undefined))) {
                    this.$notify({
                        type: 'error',
                        title: 'Ошибка!',
                        text: 'Форма содержит недопустимые поля.'
                    });
                }
            }
            if (typeof(data.message) !== (typeof undefined === 'undefined' ? 'undefined' : typeof(undefined))) {
                this.$notify({
                    type: 'error',
                    title: 'Ошибка!',
                    text: data.message
                });
            }
        },
    }
};
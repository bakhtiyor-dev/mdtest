import './bootstrap';
import 'vue-multiselect/dist/vue-multiselect.min.css';
import 'vue-select/dist/vue-select.css';
import './app-components/bootstrap';
import './index';
import './answertypes.js';
import '../printable.js';
import 'craftable/dist/ui';
import 'flatpickr/dist/flatpickr.css';
import {Admin} from 'craftable';
import Vue from 'vue';
import VueProgressBar from 'vue-progressbar';
import vSelect from 'vue-select';
import flatPickr from 'vue-flatpickr-component';
import Multiselect from 'vue-multiselect';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import VeeValidate, {Validator} from 'vee-validate';
import VueCookie from 'vue-cookie';
import VModal from 'vue-js-modal';
import ru from 'vee-validate/dist/locale/ru';

Vue.config.silent = false;

Vue.use(VeeValidate, {strict: true, locale: 'ru'});
Vue.use(VModal, {dialog: true, dynamic: true, injectModalsContainer: true});
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);

Vue.use(VueProgressBar, {
    color: '#FBC200',
    failedColor: 'red',
    thickness: '4px',
});

Validator.localize('ru', ru);

Vue.component('datetime', flatPickr);
Vue.component('v-select', vSelect);
Vue.component('multiselect', Multiselect);
/* custom components: */
Vue.component('test-category-count', () => import('./components/TestCategoryCount'));
Vue.component('import-modal', () => import('./components/ImportModal'));
Vue.component('rating-settings', () => import('./components/RatingSettings'));
Vue.component('rating-settings-view', () => import('./components/RatingSettingsView'));

let app = new Vue({
    mixins: [Admin]
});

axios.interceptors.request.use((request) => {
    app.$Progress.start();
    return request;
}, (error) => {
    app.$Progress.fail();
    return Promise.reject(error);
});

axios.interceptors.response.use((response) => {
        app.$Progress.finish();

        if (response.data.hasOwnProperty('message'))
            app.$notify({
                type: 'success',
                duration: 5000,
                title: 'Успех!',
                text: response.data.message
            });

        return response;
    }, (error) => {
        app.$Progress.fail();

        let text = error.response.data.message;

        if (error.response.config.responseType === 'blob') {
            const fr = new FileReader();
            fr.onload = (e) => {
                app.$notify({
                    type: 'error',
                    duration: -1,
                    title: 'Ошибка!',
                    text: JSON.parse(e.target.result).message
                });
            };
            fr.readAsText(error.response.data);
            return Promise.reject(error);
        }

        if (error.response.data.exception)
            text = error.response.data.exception + ':' + text;

        app.$notify({
            type: 'error',
            duration: -1,
            title: 'Ошибка!',
            text: text
        });

        return Promise.reject(error);
    }
);

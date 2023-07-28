import AppListing from '../app-components/Listing/AppListing';
import VueSlider from 'vue-slider-component';
import 'vue-slider-component/theme/antd.css';

Vue.component('exam-user-attempt-listing', {
    mixins: [AppListing],
    components: {
        VueSlider
    },
    data() {
        return {
            filters: {
                result: [0, 100],
            },
            loadingExport: false
        }
    },

    methods: {
        exportData() {
            this.loadingExport = true;
            axios.post('/admin/exam-user-attempts/export', {items: this.bulkItems}, {
                responseType: 'blob'
            }).then((reponse) => {
                downloadFile('report', reponse.data);
                this.loadingExport = false;
            });
        }
    }
});
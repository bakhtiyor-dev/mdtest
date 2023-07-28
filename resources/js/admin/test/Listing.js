import AppListing from '../app-components/Listing/AppListing';

Vue.component('test-listing', {
    mixins: [AppListing],
    props: ['exportAction'],
    computed: {
        answerTypes() {
            return ANSWER_TYPES;
        },

        statuses() {
            return [
                {
                    title: 'Доступные',
                    value: '1'
                },
                {
                    title: 'Недоступные',
                    value: '0'
                }
            ]
        }
    },

    methods: {
        exportTests() {
            axios.post(this.exportAction, {items: this.bulkItems}, {responseType: 'blob'})
                .then((response) => {
                    downloadFile('tests', response.data);
                });
        }

    }
});
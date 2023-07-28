import DoughnutChart from "./DoughnutChart";
import BarChart from "./BarChart";

Vue.component('analytics', {
    components: {DoughnutChart, BarChart},
    props: ['initialData'],
    data() {
        return {
            data: '',
            filters: {}
        }
    },
    created() {
        this.data = this.initialData;
    },
    computed: {
        attemptStatsData() {
            return {
                labels: this.data.grouped_attempts[0],
                datasets: [{
                    data: this.data.grouped_attempts[1],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 235)',
                        'rgb(8,215,128)'
                    ]
                }]
            }
        },
        testStatsData() {
            return {
                labels: this.data.grouped_tests.map(obj => obj['answer_type']),
                datasets: [{
                    label: 'Количество тестов',
                    barThickness: 100,
                    data: this.data.grouped_tests.map(obj => obj['amount']),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(18,152,241)',
                        'rgb(8,215,128)',
                    ]

                }],

            }
        },
    },

    methods: {
        filter(param, value) {
            let vm = this;

            this.filters[param] = value;

            axios.get('/admin', {
                params: this.filters
            }).then(function (response) {
                vm.data = response.data.data;
            })
        }
    }

});
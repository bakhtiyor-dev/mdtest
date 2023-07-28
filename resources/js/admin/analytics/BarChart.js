import {Bar, mixins} from 'vue-chartjs'

const {reactiveProp} = mixins

export default Vue.component('bar-chart', {
    extends: Bar,
    mixins: [reactiveProp],
    props: ['chartData'],

    mounted() {
        this.renderChart(this.chartData, {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        precision: 0,
                        suggestedMin: 0,
                        beginAtZero: true
                    },
                }]
            }
        });
    }
});




import {Doughnut, mixins} from 'vue-chartjs'

const {reactiveProp} = mixins

export default Vue.component('doughnut-chart', {
    extends: Doughnut,
    mixins: [reactiveProp],
    props: ['chartData'],
    mounted() {
        this.renderChart(this.chartData, {
            maintainAspectRatio: false
        })
    }
});




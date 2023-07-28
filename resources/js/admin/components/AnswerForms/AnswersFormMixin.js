export default {
    props: ['value', 'config'],
    data() {
        return {
            answers: this.value,
        }
    },
    watch: {
        answers: {
            handler: function (newVal) {
                this.$emit('input', newVal);
            },
            deep: true
        }
    },

    computed:{
      lastId(){
          return Math.max(...this.answers.data.answers.map(o => o.id), 0)
      }
    },

    methods: {
        add() {
            this.answers.data.answers.push({
                id: this.lastId + 1,
                answer: ''
            })
        },
        remove(index) {
            this.answers.data.answers.splice(index, 1);
        }
    }
}
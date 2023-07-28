<template>
  <div class="card text-black">

    <div class="border-bottom bg-gray text-bold-600 p-2 d-flex">
      <div class="question">
        {{ index }}.
      </div>
      <div v-html="test.body"></div>
    </div>

    <div class="card-body">
      <textarea class="form-control" v-model="givenAnswer"></textarea>
    </div>

  </div>
</template>

<script>

export default {
  name: "TextInputAnswerTest",
  props: ['test', 'index'],
  data() {
    return {
      currentTest: this.test,
      givenAnswer: ''
    }
  },

  created() {
    if (this.currentTest.hasOwnProperty('given_answer'))
      this.givenAnswer = this.currentTest.given_answer;
  },
  watch: {
    givenAnswer(answer) {

      if (answer.trim() !== '') {
        this.$set(this.currentTest, 'given_answer', answer);
        this.$set(this.currentTest, 'is_answered', true);
      } else {
        delete this.currentTest['given_answer'];
        delete this.currentTest['is_answered'];
      }

      this.$emit('answered', this.currentTest);
    }
  }

}
</script>

<style scoped>

.answer {
  margin-right: 10px;
  margin-top: 5px;
}

.question {
  margin-right: 5px;
}

</style>

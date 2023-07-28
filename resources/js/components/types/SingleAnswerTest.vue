<template>
  <div class="card text-black">

    <div class="border-bottom bg-gray text-bold-600 p-2 d-flex">
      <div class="question">
        {{ index }}.
      </div>
      <div v-html="test.body"></div>
    </div>

    <div class="card-body p-0">

      <ul class="list-group list-group-flush">
        <label class="list-group-item d-flex py-1"
               v-for="answer in test.answers.answers"
               :key="answer.id"
               :class="{'bg-gray': answer.id === test.selected_id}">

          <div class="answer">
            <input type="radio"
                   class="form-check"
                   name="correct_answer"
                   :value="answer.id"
                   v-model="selectedAnswerId">
          </div>

          <div v-html="answer.answer"></div>

        </label>
      </ul>

    </div>

  </div>
</template>

<script>

export default {
  name: "SingleAnswerTest",
  props: ['test', 'index'],
  data() {
    return {
      currentTest: this.test,
      selectedAnswerId: ''
    }
  },

  created() {
    if (this.currentTest.hasOwnProperty('selected_id'))
      this.selectedAnswerId = this.currentTest.selected_id;
  },

  watch:{
    selectedAnswerId(id){
      this.$set(this.currentTest, 'selected_id', id);
      this.$set(this.currentTest, 'is_answered', true);

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

label{
  cursor: pointer;
}

.question {
  margin-right: 5px;
}

</style>

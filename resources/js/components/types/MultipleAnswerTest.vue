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
               :key="answer.id">

          <div class="answer">
            <input type="checkbox"
                   class="form-check"
                   :value="answer.id"
                   v-model="selectedIds">
          </div>

          <div v-html="answer.answer"></div>

        </label>
      </ul>
    </div>
  </div>
</template>

<script>

export default {
  name: "MultipleAnswerTest",
  props: ['test', 'index'],

  data() {
    return {
      currentTest: this.test,
      selectedIds: []
    }
  },

  created() {
    if (this.currentTest.hasOwnProperty('selected_ids'))
      this.selectedIds = this.currentTest.selected_ids;
  },

  watch: {
    selectedIds(ids) {
      if (ids.length !== 0) {
        this.$set(this.currentTest, 'selected_ids', ids);
        this.$set(this.currentTest, 'is_answered', true);
      } else {
        delete this.currentTest['is_answered']
        delete this.currentTest['selected_ids']
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

label{
  cursor: pointer;
}

.question {
  margin-right: 5px;
}
</style>



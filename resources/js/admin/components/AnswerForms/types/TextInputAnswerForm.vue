<template>
  <div>
    <div>
      <label>Ответ к вопросу:</label>
      <small class="text-danger">
        (Примечание: ответ на этот тип вопроса сравнивается с правильным ответом один к одному)
      </small>
    </div>
    <div>
      <textarea class="form-control" v-model="answers.data.correct_answer"></textarea>
    </div>

  </div>
</template>

<script>
import AnswersFormMixin from "../AnswersFormMixin";

export default {
  name: "TextInputAnswerForm",
  mixins: [AnswersFormMixin],
  created() {
    if (this.value.data === '')
      this.answers = {
        data: {
          correct_answer: ''
        }
      }
  }
}
</script>
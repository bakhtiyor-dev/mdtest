<template>
  <div>
    <div class="clearfix mb-2">
      <p class="float-left"><strong>Ответы (минимум 4):</strong></p>
      <button class="btn btn-primary rounded-0 float-right" @click.prevent="add">+ Добавить</button>
    </div>

    <div class="mb-3" v-for="(answer,index) in answers.data.answers" :key="answer.id">
      <button v-if="index > 3" class="btn btn-danger rounded-0 float-right ml-1" @click.prevent="remove(index)">x
      </button>
      <div class="d-flex">
        <div>
          <input class="form-check-input" type="radio" name="correct_answer_id" :value="answer.id"
                 v-model="answers.data.correct_answer_id">
        </div>
        <wysiwyg v-model="answer.answer"
                 :config="config"></wysiwyg>
      </div>

    </div>
  </div>
</template>

<script>
import AnswersFormMixin from "../AnswersFormMixin";

export default {
  name: "SingleChoiceAnswerForm",
  mixins: [AnswersFormMixin],
  created() {
    if (this.value.data === '')
      this.answers = {
        data: {
          answers: [
            {id: 1, answer: ''},
            {id: 2, answer: ''},
            {id: 3, answer: ''},
            {id: 4, answer: ''}
          ],
          correct_answer_id: ''
        }
      }
  }
}
</script>
<template>
  <div>

    <div v-if="type === answerType.SINGLE_CHOICE">
      <single-choice-answer-form
          :config="config"
          v-model="answers">
      </single-choice-answer-form>
    </div>

    <div v-if="type === answerType.MULTIPLE_CHOICE">
      <multiple-choice-answers-form
          :config="config"
          v-model="answers">
      </multiple-choice-answers-form>
    </div>

    <div v-if="type === answerType.TEXT_INPUT">
      <text-input-answer-form
          :config="config"
          v-model="answers">
      </text-input-answer-form>
    </div>

    <div v-if="type === answerType.RIGHT_ORDER">
      <right-order-answer-form
          :config="config"
          v-model="answers">
      </right-order-answer-form>
    </div>

  </div>
</template>

<script>

import SingleChoiceAnswerForm from "./types/SingleChoiceAnswerForm";
import MultipleChoiceAnswersForm from "./types/MultipleChoiceAnswerForm";
import TextInputAnswerForm from "./types/TextInputAnswerForm";
import RightOrderAnswerForm from "./types/RightOrderAnswerForm";

export default {
  name: "AnswersForm",
  components: {
    SingleChoiceAnswerForm,
    MultipleChoiceAnswersForm,
    TextInputAnswerForm,
    RightOrderAnswerForm
  },

  props: ['type', 'value', 'config'],

  data() {
    return {
      answers: this.value
    }
  },

  computed: {
    answerType() {
      return ANSWER_TYPE;
    }
  },

  watch: {
    answers: {
      handler: function (newVal) {
        this.$emit('input', newVal);
      },
      deep: true
    },

    type() {
      this.answers.data = '';
    }
  }

}
</script>

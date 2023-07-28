<template>
  <div>
    <div>
      <button class="btn btn-primary btn-sm mb-2" @click.prevent="add">
        <i class="fa fa-plus"></i>
      </button>
      <label> Расстановите ответы в правильном порядке:</label>
    </div>

    <div>

      <draggable tag="ul" :list="answers.data.answers" class="list-group " handle=".handle">
        <li
            class="list-group-item d-flex justify-content-between mb-1"
            v-for="(answer, index) in answers.data.answers"
            :key="answer.id"
        >
          <div>
            <i class="fa fa-arrows handle font-large"></i>
          </div>

          <textarea class="form-control mx-3" v-model="answer.answer"></textarea>

          <i class="fa fa-times text-danger font-large" @click.prevent="remove(index)"></i>
        </li>
      </draggable>
    </div>

  </div>
</template>

<script>
import draggable from "vuedraggable";
import AnswersFormMixin from "../AnswersFormMixin";

export default {
  name: "RightOrderAnswerForm",
  mixins: [AnswersFormMixin],
  components: {
    draggable
  },
  created() {
    if (this.value.data === '')
      this.answers = {
        data: {
          answers: [
            {id: 1, answer: ''},
            {id: 2, answer: ''}
          ],
          correct_order: []
        }
      }
  },

  computed: {
    correctOrder() {
      if(this.answers.data.answers)
        return this.answers.data.answers.map(obj => obj.id);
    }
  },

  watch: {
    correctOrder(order) {
      this.answers.data.correct_order = order;
    }
  }
};
</script>

<style scoped>
.handle {
  cursor: grab;
}

.font-large {
  font-size: 20px;
}

.fa-times {
  cursor: pointer;
}

</style>

<template>

  <div class="card text-black">
    <div class="border-bottom bg-gray text-bold-600 p-2 d-flex">
      <div class="question">
        {{ index }}.
      </div>
      <div v-html="test.body"></div>
    </div>

    <div class="card-body p-2">

      <draggable tag="ul" :list="currentTest.answers.answers" class="list-group" handle=".handle">
        <li
            class="list-group-item mb-1 rounded-0 handle"
            v-for="(answer, index) in test.answers.answers"
            :key="answer.id">

          <p>{{ answer.answer }}</p>

        </li>
      </draggable>
    </div>

  </div>
</template>

<script>

import draggable from "vuedraggable";

export default {
  name: "RightOrderAnswerTest",
  components: {
    draggable
  },
  props: ['test', 'index'],
  data() {
    return {
      currentTest: this.test
    }
  },

  computed: {
    currentOrder() {
      return this.currentTest.answers.answers.map(obj => obj.id);
    }
  },

  watch: {
    currentOrder(order) {
      this.$set(this.currentTest, 'selected_order', order);
      this.$set(this.currentTest, 'is_answered', true);
      this.$emit('answered', this.currentTest);
    }
  }

}
</script>

<style scoped>
.handle {
  cursor: move;
}
</style>

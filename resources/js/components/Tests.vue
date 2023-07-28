<template>
  <div>
    <timer :seconds="exam.time * 60" @timeup="finished = true"></timer>

    <div class="row">

      <div class="col-lg-8">

        <div v-if="currentTest.answers_type === ANSWER_TYPE.SINGLE_CHOICE ">
          <single-answer-test :test="currentTest"
                              :key="currentIndex"
                              @answered="answered"
                              :index="currentIndex+1">
          </single-answer-test>
        </div>

        <div v-if="currentTest.answers_type === ANSWER_TYPE.MULTIPLE_CHOICE ">
          <multiple-answer-test :test="currentTest"
                                :key="currentIndex"
                                @answered="answered"
                                :index="currentIndex+1">
          </multiple-answer-test>
        </div>

        <div v-if="currentTest.answers_type === ANSWER_TYPE.TEXT_INPUT ">
          <text-input-answer-test :test="currentTest"
                                  :key="currentIndex"
                                  @answered="answered"
                                  :index="currentIndex+1">
          </text-input-answer-test>
        </div>

        <div v-if="currentTest.answers_type === ANSWER_TYPE.RIGHT_ORDER ">
          <right-order-answer-test :test="currentTest"
                                   :key="currentIndex"
                                   @answered="answered"
                                   :index="currentIndex+1">
          </right-order-answer-test>
        </div>

        <div class="clearfix">
          <button class="btn btn-outline-secondary float-left" :disabled="state.disablePrev" @click="prev"><i
              class="fas fa-arrow-left"></i> Назад
          </button>
          <button class="btn btn-outline-secondary float-right" :disabled="state.disableNext" @click="next"><i
              class="fas fa-arrow-right"></i> Далее
          </button>
        </div>

      </div>

      <div class="col-lg-4">
        <tests-navigator :tests="tests"
                         :current-test-id="currentTest.id"
                         @toggle="toggle"
                         @finish="finish"
                         :disable-complete="this.state.disableComplete">
        </tests-navigator>
      </div>
    </div>

    <slot :tests="tests"></slot>

    <div class="modal fade" id="modal" tabindex="-1"
         role="dialog"
         aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
            <h1 class="text-danger">
              <i class="fas fa-exclamation-circle"></i>
            </h1>
            <h4>У вас {{ notAnsweredCount }} нерешённых тестов. Действительно хотите завершить?</h4>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary float-right" @click="finished = true">
              Завершить
            </button>
            <button type="button" class="btn btn-outline-secondary"
                    data-dismiss="modal">Отмена
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>

import BaseExam from "./mixins/BaseExam";

import SingleAnswerTest from './types/SingleAnswerTest';
import MultipleAnswerTest from './types/MultipleAnswerTest'
import TextInputAnswerTest from "./types/TextInputAnswerTest";
import RightOrderAnswerTest from "./types/RightOrderAnswerTest";

import TestsNavigator from "./TestsNavigator";
import Timer from './Timer';

export default {
  name: "Tests",
  mixins: [BaseExam],

  components: {
    SingleAnswerTest,
    MultipleAnswerTest,
    TextInputAnswerTest,
    RightOrderAnswerTest,
    Timer,
    TestsNavigator
  },

  props: {
    exam: {
      type: Object,
      required: true
    },
    _tests: {
      type: Array,
      required: true
    },
    url: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      tests: this._tests,
      currentTest: this._tests[0],
      currentIndex: 0,
      finished: false,
      preventReload: true,
      preventClose: false
    }
  }
}
</script>

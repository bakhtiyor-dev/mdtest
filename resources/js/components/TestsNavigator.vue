<template>
  <div class="card">
    <div class="card-body">
      <button class="btn navigation-btn"
              :class="[
                  {'btn-primary border border-dark': test.is_answered},
                  {'border border-primary' : currentTestId === test.id },
                  {'btn-outline-secondary': !(test.is_answered || currentTestId === test.id)}
              ]"
              v-for="(test,index) in tests"
              :key="index"
              @click.prevent="$emit('toggle',index)">
        {{ index + 1 }}
      </button>
    </div>
    <div class="card-footer">
      <button class="btn btn-primary float-right" :disabled="disableComplete" @click="$emit('finish')">Завершить
      </button>
    </div>

  </div>
</template>

<script>
export default {
  name: "TestsNavigator",
  props: ['tests', 'currentTestId', 'disableComplete']
}
</script>

<style scoped>
.navigation-btn {
  width: 50px;
  padding: 10px;
  margin: 2px;
  border-width: 3px;
}

</style>

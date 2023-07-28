<template>
  <div>
    <a href="#" class="btn btn-primary" style="margin-bottom: 20px;" @click.prevent="add">
      <i class="icon icon-plus"></i>
    </a>

    <div class="row">
      <div v-for="(test_category_count,index) in test_category_counts" class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <div style="margin-bottom: 20px">
              <button type="button" @click="remove(index)" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="form-group">

              <label for="select">Категория:</label>

              <v-select :options="categories"
                        id="select"
                        label="title"
                        v-model="test_category_count.test_category_id"
                        :reduce="function(option) { return option.id }">
              </v-select>

              <div v-if="test_category_count.test_category_id" class="mt-2 text-danger">
                Категория <b>{{ categoryInfo(test_category_count.test_category_id).title }}</b>
                имеет <b>{{ categoryInfo(test_category_count.test_category_id).tests_count }}</b> доступных тестов
              </div>

            </div>


            <div class="form-group">
              <label for="count">Кол-во:</label>
              <input id="count" type="number" placeholder="Количество тестов" class="form-control"
                     v-model="test_category_count.tests_count">

            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="panel panel-danger" style="margin: 0">
          <div class="panel-body">
            <label>Общее количество тестов:</label>
            <input class="form-control" type="number" v-model="count" readonly>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </div>
</template>

<script>
export default {

  name: 'TestCategoryCount',
  props: {
    value: {},
    test_categories: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      test_category_counts: this.value
    }
  },

  created() {
    if (this.value === '')
      this.test_category_counts = [{test_category_id: null, tests_count: 0}];
  },

  computed: {
    categories() {
      return this.test_categories;
    },
    count() {
      return this.test_category_counts.reduce((n, {tests_count}) => +n + +tests_count, 0);
    }
  },

  watch: {
    test_category_counts: {
      handler: function (val) {
        this.$emit('input', val);
      },
      deep: true
    }
  },

  methods: {
    add() {
      this.test_category_counts.push({
        test_category_id: '',
        tests_count: 0
      })
    },

    remove(index) {
      if (this.test_category_counts.length > 1)
        this.test_category_counts.splice(index, 1);
    },

    categoryInfo(id) {
      return this.categories.find(obj => obj.id === id);
    }

  }
}
</script>
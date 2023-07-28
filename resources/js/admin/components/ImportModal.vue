<template>
  <div>
    <modal name="import" height="auto">
      <div class="card">
        <div class="card-header">

          <h6 class="text-primary">
            Импорт тестов с файла
            <i class="fa fa-file-excel-o ml-1"></i> Excel
          </h6>

          <p class="text-danger"> (Примечание: одинаковые и вопросы имеющиеся в базе данных будут пропущены)</p>

          <h6>Шаблоны для импорта:</h6>

          <ul>
            <li>
              <a href="/importpatterns/single_choice_import_pattern.xlsx" class="text-primary">
                <i class="fa fa-download"></i>
                Выбор одного варианта ответа
              </a>
            </li>

            <li>
              <a href="/importpatterns/multiple_choice_import_pattern.xlsx" class="text-primary">
                <i class="fa fa-download"></i>
                Выбор нескольких вариантов ответа
              </a>
            </li>

            <li>
              <a href="/importpatterns/text_input_import_pattern.xlsx" class="text-primary">
                <i class="fa fa-download"></i>
                Ввод ответа с клавиатуры
              </a>
            </li>

            <li>
              <a href="/importpatterns/right_order_import_pattern.xlsx" class="text-primary">
                <i class="fa fa-download"></i>
                Расстановка в нужном порядке
              </a>
            </li>
          </ul>
        </div>

        <div class="card-body">

          <form id="form" @submit.prevent="onSubmit">
            <div class="mb-3">

              <label class="text-dark">Тип тестов:</label>

              <v-select :options="answerTypes"
                        label="title"
                        v-model="test_type"
                        required
                        :reduce="function (option) {return option.type } ">
              </v-select>

            </div>

            <div class="mb-3">
              <label class="text-dark">Категория:</label>

              <v-select :options="categories"
                        label="title"
                        v-model="category_id"
                        :reduce="function (category) {return category.id}">
              </v-select>
            </div>

            <div class="mt-2 mb-3">
              <label class="text-dark">Файл:</label>

              <input type="file"
                     name="file"
                     accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                     id="file"
                     class="form-control"
                     required>
            </div>

            <button type="submit" class="btn btn-primary float-right">
              <i class="fa" :class="submitting ? 'fa-spinner' : 'fa-download'"></i> Импортировать
            </button>

          </form>

        </div>
      </div>
    </modal>
  </div>
</template>

<script>

export default {
  name: "ImportModal",
  props: ['action', 'categories'],

  data() {
    return {
      category_id: '',
      test_type: '',
      submitting: false
    }
  },

  computed: {
    answerTypes() {
      return ANSWER_TYPES;
    }
  },

  methods: {
    onSubmit() {
      this.submitting = true;

      let formData = new FormData();
      let self = this;

      formData.append('test_type', this.test_type);
      formData.append('category_id', this.category_id);
      formData.append('file', document.getElementById('file').files[0]);

      axios.post(this.action,
          formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      ).then(() => {
        this.submitting = false;
        this.$modal.hide('import');
      }).catch(() => this.submitting = false);

    },


  }
}
</script>
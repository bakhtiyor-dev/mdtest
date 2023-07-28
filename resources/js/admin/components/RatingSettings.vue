<template>
  <div>
    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>От: (%)</th>
            <th>До: (%)</th>
            <th>Уровень:</th>
            <th></th>
            <th>
              <button class="btn btn-sm btn-primary" @click.prevent="add">
                <i class="icon icon-plus"></i>
              </button>
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(setting, index) in settings">

            <td>
              <input style="width: 100px; height: 35px" min="0" max="100"
                     v-model="setting.start"
                     type="number">
              %
            </td>

            <td>
              <input style="width: 100px; height: 35px"
                     v-model="setting.end"
                     type="number">
              %
            </td>

            <td>
              <input type="text" class="form-control"
                     :style="{color: setting.color}"
                     v-model="setting.comment"
                      placeholder="напр. Удовлетворительно">
            </td>

            <td>
              <input type="color" v-model="setting.color">
            </td>

            <td>
              <button class="btn btn-sm btn-danger" @click.prevent="remove(index)">
                <i class="icon icon-trash"></i>
              </button>
            </td>

          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RatingSettings",
  props: {
    value: {
      type: Array,
      default() {
        return [
        {
          start: 0,
          end: 100,
          comment: '',
          color: '#000000'
        }
        ]
      }

    }
  },
  data() {
    return {
      settings: this.value
    }
  },

  watch: {
    settings:{
      handler: function (newVal) {
        this.$emit('input', newVal);
      },
      deep:true
    }
  },

  methods: {
    add() {
      let lastEnd = this.settings[this.settings.length - 1].end;
      if (lastEnd < 100)
        this.settings.push({
          start: lastEnd,
          end: 100,
          comment: '',
          color: '#000000'
        })
      else
        this.$notify({type: 'warn', text: 'Максимальный предел 100%'});
    },

    remove(index) {
      if (index > 0)
        this.settings.splice(index, 1);
    }
  }
}
</script>

<style scoped>

</style>
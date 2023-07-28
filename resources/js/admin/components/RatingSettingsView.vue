<template>
    <div>
        <ul>
          <li v-for="setting in settings">
            ({{setting.start}}% - {{setting.end}}%)  <strong :style="{color: setting.color}">{{setting.comment}}</strong>
          </li>
        </ul>
    </div>
</template>

<script>
export default {
  name: "RatingSettingsView",
  props:['settings']
}
</script>

<style scoped>

</style>
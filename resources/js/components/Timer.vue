<template>
  <div class="row">

    <div class="col-lg-8">
      <div class="progress progress-bar-primary" style="height: 15px">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="20"
             aria-valuemin="20" aria-valuemax="100" :style="{width: progress +'%'}"></div>
      </div>
    </div>

    <div class="col-lg-4">
      <h2 class="m-0 p-0 mb-1">
        <i class="feather icon-clock"></i>
        <countdown :end-time="new Date().getTime() + seconds * 1000"
                   @process="process"
                   @finish="$emit('timeup')">
          <span
              slot="process"
              slot-scope="{ timeObj }">{{ `Время: ${timeObj.m}:${timeObj.s}` }}</span>
          <span slot="finish">Время истек!</span>
        </countdown>
      </h2>
    </div>

  </div>

</template>

<script>
import vueAwesomeCountdown from 'vue-awesome-countdown';

export default {
  name: 'Timer',
  props: ['seconds'],
  components: {vueAwesomeCountdown},
  data() {
    return {
      progress: 100,
    }
  },
  methods: {
    process(vm) {
      this.progress = this.progress - (100 / this.seconds);
    }
  }

};
</script>


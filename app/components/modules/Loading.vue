<template>
  <div class="loading">
    <div class="loading-icon" />
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'

export default defineComponent({
  setup() {
    return {}
  },
})
</script>

<style lang="scss" scoped>
.loading-icon,
.loading-icon::after {
  border-radius: 50%;
  width: 10em;
  height: 10em;
}

.loading-icon {
  margin: 60px auto;
  font-size: 10px;
  position: relative;
  text-indent: -9999em;
  border-top: 1.1em solid rgba(#000, 0.2);
  border-right: 1.1em solid rgba(#000, 0.2);
  border-bottom: 1.1em solid rgba(#000, 0.2);
  border-left: 1.1em solid #000;
  transform: translateZ(0);
  animation: loading 1.1s infinite linear;
}

@keyframes loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>

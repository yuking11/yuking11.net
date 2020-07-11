<template>
  <div class="loading">
    <span class="icon-loading"
      ><SvgIcon name="loading" title="loading..."
    /></span>
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
.icon-loading {
  svg {
    animation: loading 1.1s infinite linear;
  }
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

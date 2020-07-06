<template>
  <div class="post-list"><slot /></div>
</template>

<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'

export default defineComponent({})
</script>

<style lang="scss" scoped>
.post-list {
  @include mq(tab) {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    margin: -1%;
  }
}
</style>

<template>
  <div class="container">
    <TheHero
      route="top"
      :title="'Yuki Saito\'s\nPortfolio Site'"
      note="Frontend Engineer"
    />
    <About class="section section-about" />
  </div>
</template>

<script lang="ts">
// import { Context } from '@nuxt/types'
import {
  defineComponent,
  // useContext,
  useMeta,
  // useFetch,
  // reactive,
  // ref,
  // toRefs,
  // SetupContext,
} from 'nuxt-composition-api'
import TheHero from '~/components/common/TheHero.vue'
import About from '~/components/pages/top/About.vue'

export default defineComponent({
  components: {
    TheHero,
    About,
  },
  head: {},
  setup() {
    // meta
    useMeta({
      title: process.env.SITE_NAME,
    })

    return {}
  },
})
</script>

<style lang="scss" scoped>
.section {
  @include section('top');
}
</style>

<template>
  <div class="container">
    <TheHero
      route="top"
      :title="'Yuki Saito\'s\nPortfolio Site'"
      note="Frontend Engineer"
    />
    <TopAbout class="section section-about" />
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
import TopAbout from '~/components/pages/top/TopAbout.vue'

export default defineComponent({
  components: {
    TheHero,
    TopAbout,
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

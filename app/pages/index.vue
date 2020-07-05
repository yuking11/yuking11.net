<template>
  <div>
    <TheHero
      route="top"
      :title="'Yuki Saito\'s\nPortfolio Site'"
      note="Frontend Engineer"
    />
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

export default defineComponent({
  components: {
    TheHero,
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

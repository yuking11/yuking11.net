<template>
  <div>
    <TheHero />
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
import TheHero from '@/components/top/TheHero.vue'

export default defineComponent({
  components: {
    TheHero,
  },
  head: {},
  setup() {
    // set title
    const siteName = 'yuking11.net'

    // meta
    useMeta({
      title: siteName,
    })

    return {}
  },
})
</script>

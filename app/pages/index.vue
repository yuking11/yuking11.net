<template>
  <div class="container">
    <TheHero
      route="top"
      :title="'Yuki Saito\'s\nPortfolio Site'"
      note="Frontend Engineer"
    />
    <TopAbout id="about" class="section section-about" />
    <TopWorks id="works" class="section section-works" />
    <TopBlog id="blog" class="section section-blog" />
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
import TopWorks from '~/components/pages/top/TopWorks.vue'
import TopBlog from '~/components/pages/top/TopBlog.vue'

export default defineComponent({
  components: {
    TheHero,
    TopAbout,
    TopWorks,
    TopBlog,
  },
  head: {},
  setup() {
    // meta
    useMeta({
      title: 'Yuki Saito’s Portfolio Site',
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

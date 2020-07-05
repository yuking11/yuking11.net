<template>
  <div class="section-title-sub">
    <component :is="tag" class="title-sub">{{ title }}</component>
  </div>
</template>

<script lang="ts">
// import { Context } from '@nuxt/types'
import {
  defineComponent,
  // useContext,
  // useMeta,
  // useFetch,
  // reactive,
  // ref,
  // toRefs,
  // SetupContext,
} from 'nuxt-composition-api'

type Props = Readonly<{
  title: string
  tag: 'h3' | 'h4' | 'h5'
}>

export default defineComponent({
  props: {
    title: {
      type: String as () => Props['title'],
      required: true,
    },
    tag: {
      type: String as () => Props['tag'],
      default: 'h3',
      validator: (value: string) => ['h3', 'h4', 'h5'].includes(value),
    },
  },
  setup(props: Props) {
    return {
      props,
    }
  },
})
</script>

<style lang="scss" scoped>
.title-sub {
  margin: 0 0 ($ct_gutter * 1.25);
  font-size: fs(20);
  line-height: 1.2;
  text-align: center;
  @include lts(80);

  @include mq(tab) {
    font-size: fs(24);
    margin-bottom: $ct_gutter * 1.5;
  }

  @include mq(pc) {
    font-size: fs(32);
    margin-bottom: $ct_gutter * 1.75;
  }
}
</style>

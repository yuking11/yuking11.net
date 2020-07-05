<template>
  <div class="section-title">
    <component :is="tag" class="title">{{ title }}</component>
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
  tag: 'h2' | 'h3' | 'h4'
}>

export default defineComponent({
  props: {
    title: {
      type: String as () => Props['title'],
      required: true,
    },
    tag: {
      type: String as () => Props['tag'],
      default: 'h2',
      validator: (value: string) => ['h2', 'h3', 'h4'].includes(value),
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
.title {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto ($ct_gutter * 1.5);
  font-size: fs(24);
  line-height: 1.2;
  text-align: center;
  @include lts(120);

  &::before,
  &::after {
    content: '';
    width: 32px;
    height: 1px;
    background-color: $font_color;
  }

  &::before {
    margin-right: $ct_gutter;
  }
  &::after {
    margin-left: $ct_gutter;
  }

  @include mq(tab) {
    font-size: fs(30);
    margin-bottom: $ct_gutter * 2;

    &::before,
    &::after {
      width: 40px;
    }
  }

  @include mq(pc) {
    font-size: fs(42);
    margin-bottom: $ct_gutter * 3;
  }
}
</style>

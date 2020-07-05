<template>
  <div class="section-title-sub">
    <component
      :is="tag"
      class="title-sub"
      :class="[variant ? `title-sub-${variant}` : '']"
    >
      {{ title }}
    </component>
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
import { variantList } from '~/utils/config'

type Props = Readonly<{
  title: string
  tag: 'h3' | 'h4' | 'h5'
  variant: string
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
    variant: {
      type: String as () => Props['variant'],
      default: '',
      varidator: (value: string) => variantList.includes(value),
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

.title-sub-primary {
  color: $base_primary_text;
  &::before,
  &::after {
    background-color: $base_primary_text;
  }
}

.title-sub-secondary {
  color: $base_secondary_text;
  &::before,
  &::after {
    background-color: $base_secondary_text;
  }
}

.title-sub-success {
  color: $base_success_text;
  &::before,
  &::after {
    background-color: $base_success_text;
  }
}

.title-sub-danger {
  color: $base_danger_text;
  &::before,
  &::after {
    background-color: $base_danger_text;
  }
}

.title-sub-warning {
  color: $base_warning_text;
  &::before,
  &::after {
    background-color: $base_warning_text;
  }
}

.title-sub-info {
  color: $base_info_text;
  &::before,
  &::after {
    background-color: $base_info_text;
  }
}

.title-sub-light {
  color: $base_light_text;
  &::before,
  &::after {
    background-color: $base_light_text;
  }
}

.title-sub-dark {
  color: $base_dark_text;
  &::before,
  &::after {
    background-color: $base_dark_text;
  }
}

.title-sub-white {
  color: $base_white_text;
  &::before,
  &::after {
    background-color: $base_white_text;
  }
}

.title-sub-black {
  color: $base_black_text;
  &::before,
  &::after {
    background-color: $base_black_text;
  }
}
</style>

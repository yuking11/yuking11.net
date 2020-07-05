<template>
  <div class="section-title">
    <component
      :is="tag"
      class="title"
      :class="[variant ? `title-${variant}` : '']"
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
  tag: 'h1' | 'h2' | 'h3'
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
      default: 'h2',
      validator: (value: string) => ['h2', 'h3', 'h4'].includes(value),
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

.title-primary {
  color: $base_primary_text;
  &::before,
  &::after {
    background-color: $base_primary_text;
  }
}

.title-secondary {
  color: $base_secondary_text;
  &::before,
  &::after {
    background-color: $base_secondary_text;
  }
}

.title-success {
  color: $base_success_text;
  &::before,
  &::after {
    background-color: $base_success_text;
  }
}

.title-danger {
  color: $base_danger_text;
  &::before,
  &::after {
    background-color: $base_danger_text;
  }
}

.title-warning {
  color: $base_warning_text;
  &::before,
  &::after {
    background-color: $base_warning_text;
  }
}

.title-info {
  color: $base_info_text;
  &::before,
  &::after {
    background-color: $base_info_text;
  }
}

.title-light {
  color: $base_light_text;
  &::before,
  &::after {
    background-color: $base_light_text;
  }
}

.title-dark {
  color: $base_dark_text;
  &::before,
  &::after {
    background-color: $base_dark_text;
  }
}

.title-white {
  color: $base_white_text;
  &::before,
  &::after {
    background-color: $base_white_text;
  }
}

.title-black {
  color: $base_black_text;
  &::before,
  &::after {
    background-color: $base_black_text;
  }
}
</style>

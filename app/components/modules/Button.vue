<template>
  <component
    :is="tag"
    :type="isLink ? null : type"
    class="btn"
    :class="[
      variant ? (outline ? `btn-${variant}-outline` : `btn-${variant}`) : '',
      icon ? `btn-icon btn-icon-${icon}` : '',
      size ? `btn-${size}` : '',
      block ? 'btn-block' : '',
      isFetching ? 'is-fetching' : '',
      isDisabled ? 'is-disabled' : '',
    ]"
    :disabled="isDisabled"
    @click="onClick"
  >
    <span class="btn-text">{{ text }}</span>
    <SvgIcon v-if="icon" :name="icon" :title="icon" />
  </component>
</template>

<script lang="ts">
// import { Context } from '@nuxt/types'
import {
  defineComponent,
  // useContext,
  // useMeta,
  // useFetch,
  // reactive,
  ref,
  // toRefs,
  // SetupContext,
} from 'nuxt-composition-api'
import { variantList } from '~/utils/config'

type Props = Readonly<{
  text: string
  icon: '' | 'refresh' | 'search' | 'external'
  type: 'button' | 'submit' | 'reset'
  variant: string
  outline: boolean
  size: 'sm' | 'lg' | 'xl'
  block: boolean
  isLink: boolean
  isFetching: boolean
  isDisabled: boolean
}>

export default defineComponent({
  props: {
    text: {
      type: String as () => Props['text'],
      required: true,
    },
    icon: {
      type: String as () => Props['icon'],
      default: '',
    },
    type: {
      type: String as () => Props['type'],
      default: 'button',
    },
    variant: {
      type: String as () => Props['variant'],
      default: '',
      varidator: (value: string) => variantList.includes(value),
    },
    outline: {
      type: Boolean as () => Props['outline'],
      default: false,
    },
    size: {
      type: String as () => Props['size'],
      default: '',
    },
    block: {
      type: Boolean as () => Props['block'],
      default: false,
    },
    isLink: {
      type: Boolean as () => Props['isLink'],
      default: false,
    },
    isFetching: {
      type: Boolean as () => Props['isFetching'],
      default: false,
    },
    isDisabled: {
      type: Boolean as () => Props['isDisabled'],
      default: false,
    },
  },
  setup(props: Props, { emit }) {
    const { isLink } = props
    const tag = ref(isLink ? 'a' : 'button')

    const onClick = () => {
      emit('click')
    }

    return {
      props,
      tag,
      onClick,
    }
  },
})
</script>

<style lang="scss" scoped>
.btn {
  display: inline-block;
  vertical-align: middle;
  background-color: $btn_default_bg;
  margin: 0;
  padding: ($ct_gutter / 3) ($ct_gutter / 1.3);
  box-sizing: border-box;
  border: 1px solid transparent;
  color: $btn_default_text;
  font-size: fs(16);
  text-align: center;
  text-decoration: none;
  line-height: 1.4;
  cursor: pointer;
  transition: color 0.2s, background-color 0.2s, border-color 0.2s,
    box-shadow 0.2s;
  &:hover {
    background-color: $btn_default_bg_hover;
  }
}

// variants

.btn-primary {
  background-color: $btn_primary_bg;
  color: $btn_primary_text;
  &:hover {
    background-color: $btn_primary_bg_hover;
  }
}

.btn-secondary {
  background-color: $btn_secondary_bg;
  color: $btn_secondary_text;
  &:hover {
    background-color: $btn_secondary_bg_hover;
  }
}

.btn-success {
  background-color: $btn_success_bg;
  color: $btn_success_text;
  &:hover {
    background-color: $btn_success_bg_hover;
  }
}

.btn-danger {
  background-color: $btn_danger_bg;
  color: $btn_danger_text;
  &:hover {
    background-color: $btn_danger_bg_hover;
  }
}

.btn-warning {
  background-color: $btn_warning_bg;
  color: $btn_warning_text;
  &:hover {
    background-color: $btn_warning_bg_hover;
  }
}

.btn-info {
  background-color: $btn_info_bg;
  color: $btn_info_text;
  &:hover {
    background-color: $btn_info_bg_hover;
  }
}

.btn-light {
  background-color: $btn_light_bg;
  color: $btn_light_text;
  &:hover {
    background-color: $btn_light_bg_hover;
  }
}

.btn-dark {
  background-color: $btn_dark_bg;
  color: $btn_dark_text;
  &:hover {
    background-color: $btn_dark_bg_hover;
  }
}

.btn-white {
  background-color: $btn_white_bg;
  color: $btn_white_text;
  &:hover {
    background-color: $btn_white_bg_hover;
  }
}

.btn-black {
  background-color: $btn_black_bg;
  color: $btn_black_text;
  &:hover {
    background-color: $btn_black_bg_hover;
  }
}

// size

.btn-sm {
  padding: ($ct_gutter / 4) $ct_gutter_half;
  font-size: fs(14);
}

.btn-lg {
  padding: $ct_gutter_half $ct_gutter;
  font-size: fs(18);
}

.btn-xl {
  padding: $ct_gutter_half ($ct_gutter * 2);
  font-size: fs(20);
}

// icon

.btn-icon {
  position: relative;
  padding-left: $ct_gutter * 2.25;

  svg {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 10px;
    z-index: 1;
    margin: auto;
    width: 1rem;
    height: 1rem;
  }
}

.btn-icon.btn-sm {
  padding-left: $ct_gutter * 1.75;

  svg {
    left: 8px;
    width: 0.75rem;
    height: 0.75rem;
  }
}

.btn-icon.btn-lg {
  padding-left: $ct_gutter * 2.75;

  svg {
    left: 14px;
    width: 1.25rem;
    height: 1.25rem;
  }
}

.btn-icon.btn-xl {
  padding-left: $ct_gutter * 3.25;

  svg {
    left: 16px;
    width: 1.375rem;
    height: 1.375rem;
  }
}

// outline

.btn-outline {
  background-color: #fff;
  color: $btn_default_text;
  border: 1px solid $btn_default_bg;
  &:hover {
    background-color: rgba($btn_default_bg, 0.65);
    color: rgba($btn_default_text, 0.65);
    border-color: rgba($btn_default_bg, 0.65);
  }
}

.btn-primary-outline {
  background-color: #fff;
  color: $btn_primary_bg;
  border: 1px solid $btn_primary_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_primary_bg, 0.65);
    border-color: rgba($btn_primary_bg, 0.65);
  }
}

.btn-secondary-outline {
  background-color: #fff;
  color: $btn_secondary_bg;
  border: 1px solid $btn_secondary_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_secondary_bg, 0.65);
    border-color: rgba($btn_secondary_bg, 0.65);
  }
}

.btn-success-outline {
  background-color: #fff;
  color: $btn_success_bg;
  border: 1px solid $btn_success_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_success_bg, 0.65);
    border-color: rgba($btn_success_bg, 0.65);
  }
}

.btn-danger-outline {
  background-color: #fff;
  color: $btn_danger_bg;
  border: 1px solid $btn_danger_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_danger_bg, 0.65);
    border-color: rgba($btn_danger_bg, 0.65);
  }
}

.btn-warning-outline {
  background-color: #fff;
  color: $btn_warning_bg;
  border: 1px solid $btn_warning_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_warning_bg, 0.65);
    border-color: rgba($btn_warning_bg, 0.65);
  }
}

.btn-info-outline {
  background-color: #fff;
  color: $btn_info_bg;
  border: 1px solid $btn_info_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_info_bg, 0.65);
    border-color: rgba($btn_info_bg, 0.65);
  }
}

.btn-light-outline {
  background-color: #fff;
  color: $btn_light_bg;
  border: 1px solid $btn_light_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_light_bg, 0.65);
    border-color: rgba($btn_light_bg, 0.65);
  }
}

.btn-dark-outline {
  background-color: #fff;
  color: $btn_dark_bg;
  border: 1px solid $btn_dark_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_dark_bg, 0.65);
    border-color: rgba($btn_dark_bg, 0.65);
  }
}

.btn-white-outline {
  background-color: #fff;
  color: $font_color;
  border: 1px solid $btn_white_bg;
  &:hover {
    background-color: #fff;
    color: rgba($font_color, 0.65);
    border-color: rgba($btn_white_bg, 0.65);
  }
}

.btn-black-outline {
  background-color: #fff;
  color: $btn_black_bg;
  border: 1px solid $btn_black_bg;
  &:hover {
    background-color: #fff;
    color: rgba($btn_black_bg, 0.65);
    border-color: rgba($btn_black_bg, 0.65);
  }
}

// state

.btn-block {
  display: block;
  width: 100%;
}

.is-fetching {
}

.is-disabled {
  opacity: 0.65;
  pointer-events: none;
}
</style>

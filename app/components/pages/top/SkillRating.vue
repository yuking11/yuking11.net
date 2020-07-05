<template>
  <div class="skill-rating">
    <dt class="skill-term">{{ term }}</dt>
    <dd
      :class="`skill-desc skill-desc-${rating}`"
      :title="getRatingText(rating)"
    >
      <span class="skill-text">{{ getRatingText(rating) }}</span>
    </dd>
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
  term: string
  rating: number
}>

export default defineComponent({
  components: {},
  props: {
    term: {
      type: String as () => Props['term'],
      required: true,
    },
    rating: {
      type: Number as () => Props['rating'],
      required: true,
    },
  },
  setup(props: Props) {
    const { getRatingText } = useRating()
    return {
      props,
      getRatingText,
    }
  },
})

// useRating

type useRating = {
  getRatingText(rating: number): void
}

type rattingText = {
  [key: number]: string
}

const useRating = (): useRating => {
  const getRatingText = (rating: number) => {
    const rattingText: rattingText = {
      0: '破滅的センス',
      1: 'ちょっとだけわかる',
      2: '基本はわかる',
      3: 'まぁまぁわかる',
      4: 'かなりわかる',
      5: '任せておけ',
    }
    return rating > 5 ? rattingText[5] : rattingText[rating]
  }

  return {
    getRatingText,
  }
}
</script>

<style lang="scss" scoped>
.skill-rating {
  display: flex;
  align-items: flex-start;
  justify-content: center;
}

.skill-desc {
  position: relative;
  margin: 0;

  &::before,
  &::after {
    position: absolute;
    top: 0;
    left: 0;
    font-size: fs(20);
    line-height: 1.2;
  }

  &::before {
    content: '★★★★★';
    z-index: 100;
    color: $font_color_splight;
  }

  &::after {
    z-index: 110;
    color: #ca0;
  }

  &-1 {
    &::after {
      content: '★';
    }
  }

  &-2 {
    &::after {
      content: '★★';
    }
  }

  &-3 {
    &::after {
      content: '★★★';
    }
  }

  &-4 {
    &::after {
      content: '★★★★';
    }
  }

  &-5 {
    &::after {
      content: '★★★★★';
    }
  }
}

.skill-term {
  @include mq(sp, max, true) {
    width: 50%;
    margin: 0;
    padding-right: $ct_gutter;
    white-space: nowrap;
    text-align: right;
  }

  @include mq(tab) {
    width: 7em;
  }
}

.skill-desc {
  @include mq(sp, max, true) {
    width: 50%;
  }

  @include mq(tab) {
    width: 7rem;
  }
}

.skill-text {
  display: block;
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
}
</style>

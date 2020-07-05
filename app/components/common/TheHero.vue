<template>
  <div class="the-hero">
    <div class="hero" :class="`hero-${route}`">
      <template v-if="route === 'top'">
        <video
          poster="~/assets/img/top/hero_01.jpg"
          muted
          autoplay
          loop
          class="hero-video"
        >
          <source src="~/assets/img/top/hero_01.mp4" type="video/mp4" />
        </video>
      </template>
      <div class="hero-content">
        <h1 class="hero-title">{{ title }}</h1>
        <p v-if="note" class="hero-note">{{ note }}</p>
      </div>
    </div>
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
  route: 'top' | 'sub'
  title: string
  note: string
}>

export default defineComponent({
  props: {
    route: {
      type: String as () => Props['route'],
      default: 'sub',
    },
    title: {
      type: String as () => Props['title'],
      required: true,
    },
    note: {
      type: String as () => Props['note'],
      default: '',
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
.the-hero {
}

.hero {
  position: relative;
}

.hero-top {
  background-color: rgba(#000, 0.5);
}

.hero-sub {
  background-color: #333;
  height: 25vh;
}

.hero-video {
  position: relative;
  z-index: -1;
  display: block;
  width: 100%;
}

.hero-content {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 100;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  max-width: calc(#{$site_width} + (#{$ct_gutter} * 2));
  margin: auto;
  padding-right: $ct_gutter;
  padding-left: $ct_gutter;
  color: #fff;
  font-weight: bold;
  line-height: 1.2;
  text-align: center;
}

.hero-title {
  white-space: pre-wrap;
  word-break: break-word;
  margin: $base_header_height_sp 0 0;
  font-size: fs(22);
  @include lts(100, true);

  @include mq(tab) {
    font-size: fs(36);
    margin-top: $base_header_height_pc;
  }

  @include mq(pc) {
    font-size: fs(48);
    @include lts(150, true);
  }
}

.hero-note {
  margin: ($ct_gutter / 2) 0 0;
  font-size: fs(18);
  @include lts(100, true);

  @include mq(tab) {
    margin-top: $ct_gutter;
    font-size: fs(22);
  }
  @include mq(pc) {
    margin-top: $ct_gutter * 1.5;
    font-size: fs(28);
    @include lts(150, true);
  }
}
</style>

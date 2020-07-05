<template>
  <div class="sns-list">
    <ul class="sns">
      <li class="sns-item">
        <a
          href="https://www.facebook.com/yuking.sa"
          class="sns-link"
          target="_blank"
          rel="noopener"
        >
          <SvgIcon
            class="sns-icon"
            name="facebook"
            title="facebook"
            :fill="fill"
          />
        </a>
      </li>
      <li class="sns-item">
        <a
          href="https://twitter.com/yuking11"
          class="sns-link"
          target="_blank"
          rel="noopener"
        >
          <SvgIcon
            class="sns-icon"
            name="twitter"
            title="twitter"
            :fill="fill"
          />
          <i class="sns-icon icon-twitter" title="Twitter"></i>
        </a>
      </li>
      <li class="sns-item">
        <a
          href="https://www.linkedin.com/in/yuki-saitoh-121198132/"
          class="sns-link"
          target="_blank"
          rel="noopener"
        >
          <SvgIcon
            class="sns-icon"
            name="linkedin"
            title="linkedin"
            :fill="fill"
          />
        </a>
      </li>
      <li class="sns-item">
        <a
          href="https://github.com/yuking11/"
          class="sns-link"
          target="_blank"
          rel="noopener"
        >
          <SvgIcon class="sns-icon" name="github" title="github" :fill="fill" />
        </a>
      </li>
    </ul>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'

type Props = Readonly<{
  fill: string
}>

export default defineComponent({
  props: {
    fill: {
      type: String as () => Props['fill'],
      default: '#000',
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
.sns-list {
}

.sns {
  display: flex;
  justify-content: center;
  align-items: center;
  list-style: none;
  margin: $ct_gutter_half ($ct_gutter / -2.5);
  padding: 0;
  line-height: 1;

  @include mq(pc) {
    margin: $ct_gutter ($ct_gutter / -3);
  }
}

.sns-item {
  width: 28px;
  height: 28px;
  margin: 0 ($ct_gutter / 2.5);
  padding: 0;

  @include mq(pc) {
    width: 32px;
    height: 32px;
    margin: 0 ($ct_gutter / 3);
    padding: 0;
  }
}

.sns-link {
  transition: all 0.35s;
  &:hover {
    opacity: 0.75;
  } // &:hover;
}

.sns-icon {
  width: 100%;
  height: 100%;
}
</style>

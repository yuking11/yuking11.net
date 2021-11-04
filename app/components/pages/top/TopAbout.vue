<template>
  <section class="top-about">
    <div class="about-inner">
      <SectionTitle title="About Me" />

      <div class="profile">
        <img
          src="~/assets/img/top/about.png"
          alt="@Yuking11"
          class="profile-img"
        />
        <div class="profile-content">
          <h3 class="profile-title">Yuki Saito（@Yuking11）</h3>
          <p class="profile-text">
            都内の会社にてフロントエンドエンジニアとして働いてます。
          </p>
          <p class="profile-text">
            Nuxt/Vueが好きで、Reactは食わず嫌いで手をつけていません...<br />
            いずれ勉強しないといけないなぁとは思っています。
          </p>
          <p class="profile-text">
            サーバーサイドも修行中、インフラ系もちょっと興味あり。
          </p>
        </div>
      </div>
    </div>
  </section>
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
import SectionTitle from '~/components/modules/SectionTitle.vue'

export default defineComponent({
  components: {
    SectionTitle,
  },
  setup() {
    return {}
  },
})
</script>

<style lang="scss" scoped>
.about-inner {
  @include inner();
}

.profile {
  margin: $ct_gutter 0 ($ct_gutter * 2);

  @include mq(tab) {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-bottom: $ct_gutter * 2;
  }

  @include mq(pc) {
    margin-bottom: $ct_gutter * 3;
  }
}

.profile-content {
  @include mq(sp, max, true) {
    margin-top: $ct_gutter;
  }

  @include mq(tab) {
    max-width: calc(700px - 200px - #{$ct_gutter * 1.5});
    margin-left: $ct_gutter * 1.5;
  }
}

.profile-title {
  margin: 0 0 $ct_gutter;

  @include mq(sp, max, true) {
    text-align: center;
  }

  @include mq(tab) {
    font-size: fs(20);
  }
}

.profile-text {
  margin: 0;

  @include mq(sp, max, true) {
    font-size: fs(14);
    text-align: justify;
  }

  @include mq(tab) {
    font-size: fs(16);
  }
}

.profile-img {
  @include mq(sp, max, true) {
    display: block;
    max-width: 200px;
    margin: auto;
  }

  @include mq(tab) {
    width: 200px;
  }
}

.skill {
  @include mq(tab) {
    max-width: 700px;
    margin: 0 auto $ct_gutter * 2;
  }
}

.skill-row {
  display: flex;
  align-items: flex-start;
  justify-content: center;

  @include mq(sp, max, true) {
    flex-wrap: wrap;
    margin: 0;
  }
}

.skill-column {
  @include mq(sp, max, true) {
    width: 100%;
  }

  @include mq(tab) {
    + .skill-column {
      margin-left: $ct_gutter * 3;
    }
  }
}
</style>

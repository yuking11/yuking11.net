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

      <SectionTitleSub title="Skills" />
      <dl class="skill">
        <div class="skill-row">
          <SkillRating class="skill-column" term="HTML" :rating="4" />
          <SkillRating class="skill-column" term="CSS／SCSS" :rating="4" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="JavaScript" :rating="3" />
          <SkillRating class="skill-column" term="Node.js" :rating="2" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="jQuery" :rating="3" />
          <SkillRating class="skill-column" term="TypeScript" :rating="2" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="gulp" :rating="3" />
          <SkillRating class="skill-column" term="webpack" :rating="3" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="Nuxt/Vue" :rating="3" />
          <SkillRating class="skill-column" term="React" :rating="0" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="PHP" :rating="2" />
          <SkillRating class="skill-column" term="MySQL" :rating="2" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="Git" :rating="3" />
          <SkillRating class="skill-column" term="Github" :rating="3" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="CircleCI" :rating="1" />
          <SkillRating class="skill-column" term="Linux" :rating="2" />
        </div>
        <div class="skill-row">
          <SkillRating class="skill-column" term="Web Design" :rating="0" />
          <SkillRating class="skill-column" term="Management" :rating="0" />
        </div>
      </dl>
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
import SectionTitleSub from '~/components/modules/SectionTitleSub.vue'
import SkillRating from '~/components/modules/SkillRating.vue'

export default defineComponent({
  components: {
    SectionTitle,
    SectionTitleSub,
    SkillRating,
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

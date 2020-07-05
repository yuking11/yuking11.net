<template>
  <section class="the-contact">
    <div class="the-contact-inner">
      <SectionTitle title="Contact" variant="white" />
      <p class="contact-description">
        以下、SNSにてメッセージいただければ幸いでございます。
      </p>
      <SnsList fill="#fff" />
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
import SnsList from '~/components/modules/SnsList.vue'

export default defineComponent({
  components: {
    SectionTitle,
    SnsList,
  },
  setup() {},
})
</script>

<style lang="scss" scoped>
.the-contact {
  @include section();
  background-color: #000;
  color: #fff;
  padding-top: $ct_gutter * 3;
  padding-bottom: $ct_gutter * 3;

  @include mq(tab) {
    padding-top: $ct_gutter * 3;
    padding-bottom: $ct_gutter * 4;
  }
}

.the-contact-inner {
  @include inner();
}

.contact-description {
  text-align: center;
  margin-bottom: 2rem;
}
</style>

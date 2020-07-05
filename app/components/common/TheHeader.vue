<template>
  <header class="the-header">
    <div class="the-header-inner">
      <HeaderLogo class="the-header-item" color="#fff" />
      <HeaderNav class="the-header-item header-nav" />
      <SnsList class="the-header-item header-sns" fill="#fff" />
    </div>
  </header>
</template>

<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'
import HeaderLogo from '~/components/common/header/HeaderLogo.vue'
import HeaderNav from '~/components/common/header/HeaderNav.vue'
import SnsList from '~/components/common/SnsList.vue'

export default defineComponent({
  components: {
    HeaderLogo,
    HeaderNav,
    SnsList,
  },
})
</script>

<style lang="scss" scoped>
.the-header {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 1000;
  background-color: rgba(#000, 0.65);
}

.the-header-inner {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  max-width: calc(#{$site_width} + (#{$ct_gutter} * 2));
  height: $base_header_height_sp;
  margin: 0 auto;
  padding: 0 $ct_gutter;

  @include mq(tab) {
    height: $base_header_height_pc;
  }
}

.the-header-item {
  &:nth-child(2) {
    margin-left: auto;
  }
  &:last-child {
    margin-left: $ct_gutter;
  }
}

.header-nav {
  display: none;
  @include mq(pc) {
    display: block;
  }
}

.header-sns {
  display: none;
  @include mq(pc) {
    display: block;
  }
}
</style>

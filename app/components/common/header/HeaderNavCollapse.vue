<template>
  <div class="header-nav-collapse">
    <input id="nav-toggle" type="checkbox" name="nav-toggle" />
    <label for="nav-toggle" class="nav-toggle-button">
      <span class="nav-toggle-icon"></span>
    </label>
    <label for="nav-toggle" class="nav-toggle-overlay"></label>
    <div class="nav-toggle-menu">
      <SnsList class="collapse-sns" />
      <HeaderNav class="collapse-nav" />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'
import HeaderNav from '~/components/common/header/HeaderNav.vue'
import SnsList from '~/components/modules/SnsList.vue'

export default defineComponent({
  components: {
    HeaderNav,
    SnsList,
  },
})
</script>

<style lang="scss" scoped>
.header-nav-collapse {
  position: fixed;
  top: 0;
  right: 0;
  z-index: 1200;

  @include mq(pc) {
    display: none;
  }
}

#nav-toggle {
  display: none;

  &:checked {
    ~ .nav-toggle-button {
      border-color: $font_color;
      &::before {
        border-top-color: $font_color;
        transform: rotate(45deg);
      }
      &::after {
        border-top-color: $font_color;
        transform: rotate(-45deg);
      }
      .nav-toggle-icon {
        opacity: 0;
      }
    }
    ~ .nav-toggle-overlay {
      right: 0;
      transition-delay: 0;
    }
    ~ .nav-toggle-menu {
      right: 0;
      transition-delay: 0.2s;
    }
  }
}

.nav-toggle-button {
  position: fixed;
  top: ($base_header_height_sp - 32) / 2;
  right: $ct_gutter;
  z-index: 1600;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  border: 1px solid #fff;
  border-radius: 4px;

  &::before,
  &::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 18px;
    height: 0;
    margin: auto;
    border-top: 2px solid #fff;
    transition: all 0.35s ease-out;
  }

  @include mq(tab) {
    top: ($base_header_height_pc - 32) / 2;
  }
}

.nav-toggle-icon {
  width: 18px;
  height: 14px;
  border-top: 2px solid #fff;
  border-bottom: 2px solid #fff;
  transition: all 0.35s ease-out;
}

.nav-toggle-overlay {
  position: absolute;
  top: -20px;
  right: -150vw;
  z-index: 900;
  display: block;
  background-color: rgba(#000, 0.65);
  width: 150vw;
  height: 120vh;
  cursor: pointer;
  transition: all 0.5s;
}

.nav-toggle-menu {
  position: absolute;
  top: 0;
  right: -80vw;
  z-index: 1000;
  width: 80vw;
  height: 96vh;
  padding: 0;
  overflow-y: scroll;
  background-color: #fff;
  transition: all 0.35s;
  transition-delay: 0;
}

.collapse-sns {
  padding: 0 ($ct_gutter / 1.5);

  ::v-deep .sns {
    justify-content: flex-start;
    height: $base_header_height_sp;
    margin-top: 0;
    margin-bottom: 0;

    @include mq(tab) {
      height: $base_header_height_pc;
    }
  }

  @include mq(pc) {
    display: none;
  }
}

.collapse-nav {
  @include mq(pc) {
    display: none;
  }
}
</style>

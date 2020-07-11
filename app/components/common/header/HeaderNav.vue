<template>
  <nav class="header-nav">
    <ul class="nav">
      <li class="nav-item">
        <a v-scroll-to="'body'" href="#" class="nav-link" @click="onClick"
          >Home</a
        >
      </li>
      <li class="nav-item">
        <a
          v-scroll-to="'#about'"
          href="#about"
          class="nav-link"
          @click="onClick"
          >About</a
        >
      </li>
      <li class="nav-item">
        <a
          v-scroll-to="'#works'"
          href="#works"
          class="nav-link"
          @click="onClick"
          >Works</a
        >
      </li>
      <li class="nav-item">
        <a v-scroll-to="'#blog'" href="#blog" class="nav-link" @click="onClick"
          >Qiita</a
        >
      </li>
      <li class="nav-item">
        <a
          v-scroll-to="'#contact'"
          href="#contact"
          class="nav-link"
          @click="onClick"
          >Contact</a
        >
      </li>
    </ul>
  </nav>
</template>

<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'

export default defineComponent({
  setup(_props, { emit }) {
    // method

    const onClick = () => {
      emit('click')
    }

    return { onClick }
  },
})
</script>

<style lang="scss" scoped>
.header-nav {
  @include mq(pc) {
    display: block;
    height: 100%;
  }
}

.nav {
  border-top: 1px solid #ccc;

  @include mq(pc) {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    border: none;
  }
}

.nav-item {
  border-bottom: 1px solid #ccc;

  @include mq(pc) {
    height: 100%;
    padding: 0;
    border: none;
  }
}

.nav-link {
  display: block;
  padding: $ct_gutter_half $ct_gutter;
  color: $font_color;
  font-size: fs(14);
  text-decoration: none;
  transition: all 0.35s;
  &:hover {
    background-color: #eee;
  }

  @include mq(tab) {
    padding: $ct_gutter;
    font-size: fs(16);
  }

  @include mq(pc) {
    display: flex;
    align-items: center;
    height: 100%;
    padding: 0 $ct_gutter;
    color: #fff;
    text-decoration: none;
    transition: all 0.35s;
    &:hover {
      background-color: rgba(#000, 0.75);
    }
  }
}
</style>

<template>
  <nav class="header-nav">
    <ul class="nav">
      <li class="nav-item">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="#about" class="nav-link">About</a>
      </li>
      <li class="nav-item">
        <a href="#portfolio" class="nav-link">Portfolio</a>
      </li>
      <li class="nav-item">
        <a href="#qiita" class="nav-link">Qiita</a>
      </li>
      <li class="nav-item">
        <a href="#contact" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
</template>

<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'

export default defineComponent({})
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

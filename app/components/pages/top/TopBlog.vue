<template>
  <section class="top-blog">
    <div class="post-inner">
      <SectionTitle title="Qiita" />

      <PostList>
        <PostListItemQiita />
        <PostListItemQiita />
        <PostListItemQiita />
        <PostListItemQiita />
        <PostListItemQiita />
      </PostList>

      <div class="button-wrapper">
        <Button
          text="More"
          size="xl"
          variant="black"
          icon="external"
          is-link
          href="https://qiita.com/yuking11"
          target="_blank"
          rel="noreferrer"
        />
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
import PostList from '~/components/modules/PostList.vue'
import PostListItemQiita from '~/components/modules/PostListItemQiita.vue'
import Button from '~/components/modules/Button.vue'

export default defineComponent({
  components: {
    SectionTitle,
    PostList,
    PostListItemQiita,
    Button,
  },
  setup() {
    return {}
  },
})
</script>

<style lang="scss" scoped>
.post-inner {
  @include inner();
}

.button-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: $ct_gutter * 2;

  @include mq(tab) {
    margin-top: $ct_gutter * 3;
  }
}
</style>

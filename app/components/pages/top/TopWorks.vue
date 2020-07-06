<template>
  <section class="top-works">
    <div class="post-inner">
      <SectionTitle title="Works" />

      <PostList>
        <PostListItem />
        <PostListItem />
        <PostListItem />
        <PostListItem />
        <PostListItem />
      </PostList>

      <div class="button-wrapper">
        <DefaultButton
          text="More"
          size="xl"
          variant="black"
          icon="refresh"
          @click="getMorePost"
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
import PostListItem from '~/components/modules/PostListItem.vue'
import DefaultButton from '~/components/modules/DefaultButton.vue'

export default defineComponent({
  components: {
    SectionTitle,
    PostList,
    PostListItem,
    DefaultButton,
  },
  setup() {
    const getMorePost = () => {
      return window.alert('getMorePost')
    }
    return {
      getMorePost,
    }
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

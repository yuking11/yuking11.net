<template>
  <section class="top-blog">
    <div class="post-inner">
      <SectionTitle title="Qiita" />

      <div class="post-content">
        <template v-if="$fetch.pending">
          <Loading class="is-loading" />
        </template>
        <PostList v-else>
          <PostListItemQiita
            v-for="item in blogData"
            :key="item.id"
            :created-at="item.created_at"
            :likes-count="item.likes_count"
            :tags="item.tags"
            :title="item.title"
            :updated-at="item.updated_at"
            :url="item.url"
          />
        </PostList>
      </div>

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
import { defineComponent, useFetch, ref } from 'nuxt-composition-api'
import { Ref } from '@vue/composition-api'
import cloneDeep from 'lodash/cloneDeep'
import { fetchApi } from '~/utils/fetchApi'
import { Qiita } from '~/types/qiita'
import SectionTitle from '~/components/modules/SectionTitle.vue'
import PostList from '~/components/modules/PostList.vue'
import PostListItemQiita from '~/components/modules/PostListItemQiita.vue'
import Button from '~/components/modules/Button.vue'
import Loading from '~/components/modules/Loading.vue'

export default defineComponent({
  components: {
    SectionTitle,
    PostList,
    PostListItemQiita,
    Button,
    Loading,
  },
  setup() {
    const { blogData } = useBlog()

    return {
      blogData,
    }
  },
})

type UseBlog = {
  blogData: Ref<Qiita[]>
}

const useBlog = (): UseBlog => {
  const state = ref<Qiita[]>([])

  // life cycle event

  useFetch(async () => {
    const { data, err } = await fetchApi<Qiita[]>(
      'https://qiita.com/api/v2/authenticated_user/items',
      {
        headers: {
          Authorization: `Bearer ${process.env.QIITA_AUTH_TOKEN}`,
        },
        params: {
          page: 1,
          per_page: 6,
        },
      }
    )

    if (err) {
      throw new Error(err.message)
    }

    state.value = cloneDeep(data)
  })

  return {
    blogData: state,
  }
}
</script>

<style lang="scss" scoped>
.post-inner {
  @include inner();
}

.post-content {
  position: relative;
}

.is-loading {
  text-align: center;
  opacity: 0.65;

  ::v-deep svg {
    width: 80px;
    height: 80px;
  }
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

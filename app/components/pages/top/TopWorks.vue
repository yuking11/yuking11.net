<template>
  <section class="top-works">
    <div class="post-inner">
      <SectionTitle title="Works" />

      <div class="post-content">
        <template v-if="$fetch.pending">
          <Loading />
        </template>
        <PostList v-else>
          <PostListItem
            v-for="item in worksData.contents"
            :key="item.id"
            :title="item.title"
            :description="item.description"
            :url="item.url"
            :tags="item.tags"
            :image="item.image"
            :published-at="item.publishedAt"
          />
        </PostList>
      </div>

      <div class="button-wrapper">
        <Button
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
import {
  defineComponent,
  // useContext,
  // useMeta,
  useFetch,
  // reactive,
  ref,
  // toRefs,
  // SetupContext,
} from 'nuxt-composition-api'
import { Ref } from '@vue/composition-api'
import cloneDeep from 'lodash/cloneDeep'
import { Works } from '~/types/api-schema'
import SectionTitle from '~/components/modules/SectionTitle.vue'
import { fetchApi } from '~/utils/fetchApi'
import PostList from '~/components/modules/PostList.vue'
import PostListItem from '~/components/modules/PostListItem.vue'
import Button from '~/components/modules/Button.vue'
import Loading from '~/components/modules/Loading.vue'

export default defineComponent({
  components: {
    SectionTitle,
    PostList,
    PostListItem,
    Button,
    Loading,
  },
  setup() {
    const { worksData } = useWorks()

    const getMorePost = () => {
      return window.alert('getMorePost')
    }

    return {
      worksData,
      getMorePost,
    }
  },
})

type UseWorks = {
  worksData: Ref<Works>
}

const useWorks = (): UseWorks => {
  const state = ref<Works>({
    contents: [],
    totalCount: 0,
    offset: 0,
    limit: 6,
  })

  // life cycle event

  useFetch(async () => {
    const { data, err } = await fetchApi<Works>('works', {
      headers: {
        'X-API-KEY': process.env.API_TOKEN,
      },
      params: {
        limit: 6,
        offset: 0,
      },
    })

    if (err) {
      throw new Error(err.message)
    }

    state.value = cloneDeep(data)

    state.value.contents.map((item) => {
      if (item.image) {
        item.image = require(`~/assets/img/works/${item.image}`)
      }
      return item
    })
  })

  return {
    worksData: state,
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

<template>
  <section class="top-works">
    <div class="post-inner">
      <SectionTitle title="Works" />

      <div class="post-content">
        <template v-if="$fetchState.pending">
          <Loading class="is-loading" />
        </template>
        <PostList v-else>
          <PostListItem
            v-for="item in worksData"
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

      <div v-if="canGetData" class="button-wrapper">
        <Button
          text="More"
          size="xl"
          variant="black"
          icon="refresh"
          @click="showMore"
        />
      </div>
    </div>
  </section>
</template>

<script lang="ts">
import {
  defineComponent,
  useContext,
  // useMeta,
  useFetch,
  computed,
  // reactive,
  ref,
  Ref,
  // toRefs,
  // SetupContext,
} from '@nuxtjs/composition-api'
import { Works, Contents } from '~/types/api-schema'
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
    // use works

    const { works, canGetData, worksData, showMore } = useWorks()

    return {
      // fetch の結果はこの ref 経由でペイロードに保存・復元される
      works,
      canGetData,
      worksData,
      showMore,
    }
  },
})

type UseWorks = {
  works: Ref<Contents[]>
  canGetData: Ref<boolean>
  worksData: Ref<Contents[]>
  showMore: () => void
}

const useWorks = (): UseWorks => {
  // create data

  const limit = 6
  const fetchLimit = 100 // API の 1 リクエストあたりの上限
  const displayCount = ref(limit)

  const state = ref<Contents[]>([])

  const { $config } = useContext()

  // computed

  const worksData = computed(() => state.value.slice(0, displayCount.value))

  const canGetData = computed(() => {
    return state.value.length > displayCount.value
  })

  // methods

  const showMore = () => {
    displayCount.value += limit
  }

  // life cycle event

  // generate 時にサーバー側でのみ実行され、全件をペイロードに埋め込む
  // （API キーはクライアントに渡さない）
  useFetch(async () => {
    const contents: Contents[] = []
    let totalCount = Infinity

    while (contents.length < totalCount) {
      const { data, err } = await fetchApi<Works>('works', {
        baseURL: $config.apiBaseUrl,
        headers: {
          'X-API-KEY': $config.apiToken,
        },
        params: {
          limit: fetchLimit,
          offset: contents.length,
        },
      })

      if (err) {
        throw new Error(err.message)
      }

      contents.push(...data.contents)
      totalCount = data.totalCount

      if (data.contents.length === 0) break
    }

    state.value = contents
  })

  return {
    works: state,
    canGetData,
    worksData,
    showMore,
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

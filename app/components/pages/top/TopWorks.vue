<template>
  <section class="top-works">
    <div class="post-inner">
      <SectionTitle title="Works" />

      <div class="post-content">
        <template v-if="$fetchState.pending && count === 0">
          <Loading class="is-loading" />
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

      <div v-if="canGetData" class="button-wrapper">
        <Button
          text="More"
          size="xl"
          variant="black"
          icon="refresh"
          :is-fetching="$fetchState.pending"
          @click="$fetch"
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
  computed,
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
    // use works

    const { count, canGetData, worksData } = useWorks()

    return {
      count,
      canGetData,
      worksData,
    }
  },
})

type UseWorks = {
  count: Ref<number>
  canGetData: Ref<boolean>
  worksData: Ref<Works>
}

const useWorks = (): UseWorks => {
  // computed

  const canGetData = computed(() => {
    return state.value.totalCount > state.value.contents.length
  })

  // create data

  const limit = 6
  const count = ref(0)

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
        limit,
        offset: count.value * limit,
      },
    })

    if (err) {
      throw new Error(err.message)
    }

    if (count.value === 0) {
      state.value = cloneDeep(data)
    } else if (count.value > 0) {
      state.value.contents.push(...data.contents)
      state.value.offset = data.offset
      state.value.totalCount = data.totalCount
    }

    count.value++
  })

  return {
    count,
    canGetData,
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

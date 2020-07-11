<template>
  <section class="top-works">
    <div class="post-inner">
      <SectionTitle title="Works" />

      <div class="post-content">
        <template v-if="$fetch.pending">
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
          :is-fetching="$fetch.pending"
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

    const { canGetData, worksData } = useWorks()

    return {
      canGetData,
      worksData,
    }
  },
})

type UseWorks = {
  canGetData: Ref<boolean>
  worksData: Ref<Works>
}

const useWorks = (): UseWorks => {
  // computed

  const canGetData = computed(() => {
    return state.value.totalCount > state.value.contents.length
  })

  // create data

  const limit = ref(6)
  const count = 6

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
        limit: limit.value,
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

    limit.value = limit.value + count
  })

  return {
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

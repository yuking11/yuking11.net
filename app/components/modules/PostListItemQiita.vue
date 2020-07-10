<template>
  <article class="post-item">
    <a :href="url" class="post-link" target="_blank" rel="noreferrer">
      <div class="post-head">
        <img
          src="~/assets/img/top/qiita_logo.png"
          alt="Qiita"
          class="post-img"
        />
        <div class="post-summary">
          <div class="post-summary-title">{{ title }}</div>
          <p class="post-summary-text">投稿日時：{{ createdDate }}</p>
          <p class="post-summary-text">更新日時：{{ updatedDate }}</p>
        </div>
      </div>
      <h3 class="post-title">{{ title }}</h3>
      <div class="post-meta">
        <SvgIcon name="thumbs-up" title="thumbs-up" />
        <p class="post-likes">
          いいね<span class="ml-2">{{ likesCount }}</span>
        </p>
      </div>
      <div class="post-meta">
        <SvgIcon name="tags" title="タグ" />
        <ul class="post-tag">
          <li v-for="tag in tags" :key="tag.name" class="tag-item">
            {{ tag.name }}
          </li>
        </ul>
      </div>
    </a>
  </article>
</template>

<script lang="ts">
import { defineComponent, computed } from 'nuxt-composition-api'
import dayjs from 'dayjs'
import { Qiita } from '~/types/qiita'

type Props = Readonly<{
  createdAt: Qiita['created_at']
  likesCount: Qiita['likes_count']
  tags: Qiita['tags']
  title: Qiita['title']
  updatedAt: Qiita['updated_at']
  url: Qiita['url']
}>

export default defineComponent({
  props: {
    createdAt: {
      type: String as () => Props['createdAt'],
      default: '',
    },
    likesCount: {
      type: Number as () => Props['likesCount'],
      required: true,
    },
    tags: {
      type: Array as () => Props['tags'],
      default: () => [],
    },
    title: {
      type: String as () => Props['title'],
      required: true,
    },
    updatedAt: {
      type: String as () => Props['updatedAt'],
      default: '',
    },
    url: {
      type: String as () => Props['url'],
      required: true,
    },
  },
  setup(props: Props) {
    // computed

    const createdDate = computed(() =>
      dayjs(props.createdAt).format('YYYY年MM月DD日 HH:mm')
    )

    const updatedDate = computed(() =>
      dayjs(props.updatedAt).format('YYYY年MM月DD日 HH:mm')
    )

    return {
      createdDate,
      updatedDate,
    }
  },
})
</script>

<style lang="scss" scoped>
.post-item {
  padding-bottom: $ct_gutter;
  box-shadow: 0 1px 2px 2px rgba(#666, 0.15);
  transition: box-shadow 0.5s;

  &:hover {
    box-shadow: 0 2px 2px 2px rgba(#666, 0.35);
    .post-summary {
      top: 0;
    }
  }

  @include mq(sp, max, true) {
    + .post-item {
      margin-top: $ct_gutter * 2;
    }
  }

  @include mq(tab) {
    width: 46%;
    margin: 2%;
  }

  @include mq(pc) {
    width: calc(94% / 3);
    margin: 1%;
  }
}

.post-link {
  display: block;
  color: $font_color;
  text-decoration: none;

  &:hover {
    .post-url {
      text-decoration: none;
    }
  }

  .post-url {
    color: $link_color_primary;
    text-decoration: underline;
  }
}

.post-link-qiita {
  color: $font_color;
  text-decoration: none;
}

.post-head {
  position: relative;
  overflow: hidden;
}

.post-summary {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background-color: rgba(#000, 0.75);
  width: 100%;
  height: 100%;
  padding: $ct_gutter;
  color: #fff;
  transition: all 0.35s;

  @include mq(sp, max, true) {
    padding: $ct_gutter;
  }

  @include mq(tab) {
    padding: $ct_gutter * 1.5;
  }

  @include mq(pc) {
    padding: $ct_gutter * 1.5;
  }
}

.post-summary-title {
  font-size: fs(16);
}

.post-summary-text {
  font-size: fs(14);

  &:first-of-type {
    margin-top: 1em;
  }
}

.post-title {
  margin: 0 0 $ct_gutter_half;
  padding: $ct_gutter_half $ct_gutter 0;
  font-size: fs(16);

  @include mq(tab) {
    font-size: fs(16);
  }

  @include mq(pc) {
    padding: $ct_gutter ($ct_gutter * 1.5) 0;
  }
}

.post-meta {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  margin: 0;
  padding: 0 $ct_gutter 0 ($ct_gutter * 2.5);
  font-size: fs(14);

  + .post-meta {
    margin-top: $ct_gutter_half;
  }

  @include mq(pc) {
    padding: 0 ($ct_gutter * 1.5) 0 ($ct_gutter * 3);
  }

  svg {
    position: absolute;
    top: 2px;
    left: $ct_gutter;
    width: 16px;
    height: 16px;
    margin-right: $ct_gutter_half;

    @include mq(tab) {
      margin-right: $ct_gutter * 0.75;
    }

    @include mq(pc) {
      left: ($ct_gutter * 1.5);
    }
  }
}

.post-tag {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  margin: 0;
  padding: 0;
  list-style: none;
}

.tag-item {
  margin-right: $ct_gutter_half;
}
</style>

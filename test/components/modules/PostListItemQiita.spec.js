import { shallowMount, createLocalVue } from '@vue/test-utils'
import PostListItemQiita from '~/components/modules/PostListItemQiita.vue'

const localVue = createLocalVue()

const defaultProps = {
  createdAt: '2020-07-11T17:00:06+09:00',
  likesCount: 10,
  tags: [{ name: 'タグ名', versions: [] }],
  title: '記事タイトル',
  updatedAt: '2020-07-11T17:00:06+09:00',
  url: 'https://qiita.com',
}

// factory メソッド
const factory = (propsData = defaultProps) => {
  return shallowMount(PostListItemQiita, {
    localVue,
    propsData,
    stubs: ['SvgIcon'],
  })
}

describe('PostListItemQiita', () => {
  test('is a Vue instance', () => {
    const wrapper = factory()
    expect(wrapper.vm).toBeTruthy()
  })

  test('propsを受け取れること', () => {
    const props = {
      createdAt: '2020-07-11T20:00:06+09:00',
      likesCount: 15,
      tags: [{ name: 'テストタグ', versions: [] }],
      title: 'テストタイトル',
      updatedAt: '2020-07-11T20:00:06+09:00',
      url: 'https://google.co.jp',
    }
    const wrapper = factory(props)

    expect(wrapper.vm.$props.createdAt).toBe('2020-07-11T20:00:06+09:00')
    expect(wrapper.vm.$props.likesCount).toBe(15)
    expect(wrapper.vm.$props.tags).toEqual([
      { name: 'テストタグ', versions: [] },
    ])
    expect(wrapper.vm.$props.title).toBe('テストタイトル')
    expect(wrapper.vm.$props.updatedAt).toBe('2020-07-11T20:00:06+09:00')
    expect(wrapper.vm.$props.url).toBe('https://google.co.jp')
  })

  test('requiredがtrueになっていること', () => {
    const wrapper = factory()
    expect(wrapper.vm.$options.props.likesCount.required).toBe(true)
    expect(wrapper.vm.$options.props.title.required).toBe(true)
    expect(wrapper.vm.$options.props.url.required).toBe(true)
  })
})

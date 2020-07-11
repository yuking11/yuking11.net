import { shallowMount, createLocalVue } from '@vue/test-utils'
import PostListItem from '~/components/modules/PostListItem.vue'

const localVue = createLocalVue()

const defaultProps = {
  title: '記事タイトル',
  description: '記事ディスクリプション',
  url: 'https://github.com',
  tags: [{ fieldId: 'tag', name: 'タグ名' }],
  image: 'dummy.png',
  publishedAt: '2020年',
}

// factory メソッド
const factory = (propsData = defaultProps) => {
  return shallowMount(PostListItem, {
    localVue,
    propsData,
    stubs: ['SvgIcon'],
  })
}

describe('PostListItem', () => {
  test('is a Vue instance', () => {
    const wrapper = factory()
    expect(wrapper.vm).toBeTruthy()
  })

  test('propsを受け取れること', () => {
    const props = {
      title: 'テストタイトル',
      description: 'テストディスクリプション',
      url: 'https://yahoo.co.jp',
      tags: [{ fieldId: 'tag', name: 'テストタグ' }],
      image: 'test.png',
      publishedAt: '2015年',
    }
    const wrapper = factory(props)

    expect(wrapper.vm.$props.title).toBe('テストタイトル')
    expect(wrapper.vm.$props.description).toBe('テストディスクリプション')
    expect(wrapper.vm.$props.url).toBe('https://yahoo.co.jp')
    expect(wrapper.vm.$props.tags).toEqual([
      { fieldId: 'tag', name: 'テストタグ' },
    ])
    expect(wrapper.vm.$props.image).toBe('test.png')
    expect(wrapper.vm.$props.publishedAt).toBe('2015年')
  })

  test('requiredがtrueになっていること', () => {
    const wrapper = factory()
    expect(wrapper.vm.$options.props.title.required).toBe(true)
  })
})

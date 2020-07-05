import { shallowMount } from '@vue/test-utils'
import SectionTitleSub from '~/components/modules/SectionTitleSub.vue'

describe('SectionTitleSub', () => {
  let wrapper

  beforeEach(() => {
    wrapper = shallowMount(SectionTitleSub, {
      propsData: {
        title: 'ページタイトル',
      },
    })
  })

  afterEach(() => {
    wrapper.destroy()
  })

  test('is a Vue instance', () => {
    expect(wrapper.vm).toBeTruthy()
  })

  test('propsを受け取れること', () => {
    wrapper.setProps({
      title: 'title',
      tag: 'h4',
    })
    expect(wrapper.vm.$props.title).toBe('title')
    expect(wrapper.vm.$props.tag).toBe('h4')
  })

  test('requiredがtrueになっていること', () => {
    expect(wrapper.vm.$options.props.title.required).toBe(true)
  })

  test('propsのバリデーションチェック', () => {
    wrapper.setProps({
      tag: 'div',
    })
    expect(wrapper.vm.$props.tag.validator).toBeFalsy()
  })
})

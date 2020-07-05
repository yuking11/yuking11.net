import { shallowMount } from '@vue/test-utils'
import SectionTitle from '~/components/modules/SectionTitle.vue'

describe('SectionTitle', () => {
  let wrapper

  beforeEach(() => {
    wrapper = shallowMount(SectionTitle, {
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
      tag: 'h3',
      variant: 'primary',
    })
    expect(wrapper.vm.$props.title).toBe('title')
    expect(wrapper.vm.$props.tag).toBe('h3')
    expect(wrapper.vm.$props.variant).toBe('primary')
  })

  test('requiredがtrueになっていること', () => {
    expect(wrapper.vm.$options.props.title.required).toBe(true)
  })

  test('propsのバリデーションチェック', () => {
    wrapper.setProps({
      tag: 'p',
      variant: 'failed',
    })
    expect(wrapper.vm.$props.tag.validator).toBeFalsy()
    expect(wrapper.vm.$props.variant.validator).toBeFalsy()
  })
})

import { shallowMount } from '@vue/test-utils'
import TheHero from '~/components/common/TheHero.vue'

describe('TheHero', () => {
  let wrapper

  beforeEach(() => {
    wrapper = shallowMount(TheHero, {
      propsData: {
        route: 'top',
        title: 'ページタイトル',
        note: 'ページディスクリプション',
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
      route: 'sub',
      title: 'title',
      note: 'note',
    })
    expect(wrapper.vm.$props.route).toBe('sub')
    expect(wrapper.vm.$props.title).toBe('title')
    expect(wrapper.vm.$props.note).toBe('note')
  })

  test('requiredがtrueになっていること', () => {
    expect(wrapper.vm.$options.props.title.required).toBe(true)
  })
})

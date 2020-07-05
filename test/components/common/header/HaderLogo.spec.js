import { shallowMount } from '@vue/test-utils'
import HeaderLogo from '~/components/common/header/HeaderLogo.vue'

let wrapper

beforeEach(() => {
  wrapper = shallowMount(HeaderLogo)
})

afterEach(() => {
  wrapper.destroy()
})

describe('HeaderLogo', () => {
  test('is a Vue instance', () => {
    const wrapper = shallowMount(HeaderLogo)
    expect(wrapper.vm).toBeTruthy()
  })

  test('propsを受け取れること', () => {
    const wrapper = shallowMount(HeaderLogo)
    wrapper.setProps({
      color: '#000',
    })
    expect(wrapper.vm.$props.color).toBe('#000')
  })
})

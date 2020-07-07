import { shallowMount } from '@vue/test-utils'
import SnsList from '~/components/modules/SnsList.vue'

describe('SnsList', () => {
  let wrapper

  beforeEach(() => {
    wrapper = shallowMount(SnsList)
  })

  afterEach(() => {
    wrapper.destroy()
  })

  test('is a Vue instance', () => {
    expect(wrapper.vm).toBeTruthy()
  })

  test('propsを受け取れること', () => {
    wrapper.setProps({
      fill: '#f00',
    })
    expect(wrapper.vm.$props.fill).toBe('#f00')
  })
})

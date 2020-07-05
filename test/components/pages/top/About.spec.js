import { shallowMount } from '@vue/test-utils'
import About from '~/components/pages/top/About.vue'

describe('About', () => {
  let wrapper

  beforeEach(() => {
    wrapper = shallowMount(About)
  })

  afterEach(() => {
    wrapper.destroy()
  })

  test('is a Vue instance', () => {
    expect(wrapper.vm).toBeTruthy()
  })
})

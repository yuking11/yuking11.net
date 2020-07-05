import { shallowMount } from '@vue/test-utils'
import TopAbout from '~/components/pages/top/TopAbout.vue'

describe('TopAbout', () => {
  let wrapper

  beforeEach(() => {
    wrapper = shallowMount(TopAbout)
  })

  afterEach(() => {
    wrapper.destroy()
  })

  test('is a Vue instance', () => {
    expect(wrapper.vm).toBeTruthy()
  })
})

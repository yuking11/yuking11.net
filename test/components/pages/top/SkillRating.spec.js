import { shallowMount } from '@vue/test-utils'
import SkillRating from '~/components/pages/top/SkillRating.vue'

describe('SkillRating', () => {
  let wrapper

  beforeEach(() => {
    wrapper = shallowMount(SkillRating, {
      propsData: {
        term: 'JEST',
        rating: 0,
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
      term: 'HTML',
      rating: 5,
    })
    expect(wrapper.vm.$props.term).toBe('HTML')
    expect(wrapper.vm.$props.rating).toBe(5)
  })

  test('requiredがtrueになっていること', () => {
    expect(wrapper.vm.$options.props.term.required).toBe(true)
    expect(wrapper.vm.$options.props.rating.required).toBe(true)
  })
})

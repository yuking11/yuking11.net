import { shallowMount, createLocalVue } from '@vue/test-utils'
import SnsList from '~/components/modules/SnsList.vue'

const localVue = createLocalVue()

// factory ãƒ¡ã‚½ãƒƒãƒ‰
const factory = () => {
  return shallowMount(SnsList, {
    localVue,
    stubs: ['SvgIcon'],
  })
}

describe('SnsList', () => {
  test('is a Vue instance', () => {
    const wrapper = factory()
    expect(wrapper.vm).toBeTruthy()
  })

  test('propsを受け取れること', () => {
    const wrapper = factory()
    wrapper.setProps({
      fill: '#f00',
    })
    expect(wrapper.vm.$props.fill).toBe('#f00')
  })
})

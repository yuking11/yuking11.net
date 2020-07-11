import { shallowMount, createLocalVue } from '@vue/test-utils'
import Loading from '~/components/modules/Loading.vue'

const localVue = createLocalVue()
// factory メソッド
const factory = (propsData) => {
  return shallowMount(Loading, {
    localVue,
    propsData,
    stubs: ['SvgIcon'],
  })
}

describe('Loading', () => {
  test('is a Vue instance', () => {
    const wrapper = factory()
    expect(wrapper.vm).toBeTruthy()
  })
})

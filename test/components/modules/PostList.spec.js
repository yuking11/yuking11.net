import { shallowMount, createLocalVue } from '@vue/test-utils'
import PostList from '~/components/modules/PostList.vue'

const localVue = createLocalVue()
// factory メソッド
const factory = () => {
  return shallowMount(PostList, {
    localVue,
  })
}

describe('PostList', () => {
  test('is a Vue instance', () => {
    const wrapper = factory()
    expect(wrapper.vm).toBeTruthy()
  })
})

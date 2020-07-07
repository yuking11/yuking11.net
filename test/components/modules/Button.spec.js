import { shallowMount, createLocalVue } from '@vue/test-utils'
import Button from '~/components/modules/Button.vue'

const localVue = createLocalVue()

const defaultProps = {
  text: 'ボタン',
}

// factory メソッド
const factory = (propsData = defaultProps) => {
  return shallowMount(Button, {
    localVue,
    propsData,
    stubs: ['SvgIcon'],
  })
}

describe('Button', () => {
  test('is a Vue instance', () => {
    const wrapper = factory()
    expect(wrapper.vm).toBeTruthy()
  })

  test('propsを受け取れること', () => {
    const props = {
      text: 'テキスト',
      icon: 'refresh',
      type: 'button',
      variant: 'primary',
      outline: true,
      size: 'lg',
      block: true,
      isLink: true,
      isFetching: true,
      isDisabled: true,
    }
    const wrapper = factory(props)

    expect(wrapper.vm.$props.text).toBe('テキスト')
    expect(wrapper.vm.$props.icon).toBe('refresh')
    expect(wrapper.vm.$props.type).toBe('button')
    expect(wrapper.vm.$props.variant).toBe('primary')
    expect(wrapper.vm.$props.outline).toBe(true)
    expect(wrapper.vm.$props.size).toBe('lg')
    expect(wrapper.vm.$props.block).toBe(true)
    expect(wrapper.vm.$props.isLink).toBe(true)
    expect(wrapper.vm.$props.isFetching).toBe(true)
    expect(wrapper.vm.$props.isDisabled).toBe(true)
  })

  test('requiredがtrueになっていること', () => {
    const wrapper = factory()
    expect(wrapper.vm.$options.props.text.required).toBe(true)
  })

  test('propsのバリデーションチェック', () => {
    const wrapper = factory({
      text: 'ボタン',
      variant: 'first',
    })
    expect(wrapper.vm.$props.variant.validator).toBeFalsy()
  })
})

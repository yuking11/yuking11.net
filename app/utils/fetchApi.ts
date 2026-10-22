import axios, { AxiosRequestConfig, AxiosResponse, AxiosError } from 'axios'

export type FetchResponse<T> = Readonly<{
  data: AxiosResponse['data']
  err: FetchError | null
}>

export type FetchError = Readonly<{
  code?: string
  status?: number
  statusText?: string
  message: string
}>

export const fetch = async <T>(
  endpoint: string,
  config: AxiosRequestConfig
): Promise<FetchResponse<T>> => {
  const { data, err } = await axios({
    url: endpoint,
    ...config,
  })
    .then((res) => {
      return { data: res.data, err: null }
    })
    .catch((err) => {
      return { data: null, err: formatFetchError(err) }
    })

  return { data, err }
}

export const fetchApi = <T>(
  endPoint: string,
  options?: AxiosRequestConfig
): Promise<FetchResponse<T>> => {
  const config: AxiosRequestConfig = {
    method: options?.method ?? 'get',
    ...options,
  }
  config.headers['Content-Type'] = 'application/json'

  return fetch(endPoint, config)
}

const formatFetchError = (err: AxiosError): FetchError => {
  return {
    code: err.code,
    status: err.response?.status ?? 500,
    statusText: err.response?.statusText ?? '不明なエラー',
    message: err.response?.data?.message ?? err.message ?? '不明なエラー',
  }
}

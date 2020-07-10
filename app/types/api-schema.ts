export type Works = {
  contents: Contents[]
  totalCount: number
  offset: number
  limit: number
}

export type Contents = {
  id: string
  createdAt: string
  updatedAt: string
  publishedAt: string
  title: string
  description: string
  url: string
  tags: Tags[]
  image: string
}

export type Tags = {
  fieldId: 'tag'
  name: string
}

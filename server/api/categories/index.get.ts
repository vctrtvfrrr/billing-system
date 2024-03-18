import { categories as categoriesTable } from '~/server/database/schema'

export default eventHandler(() => {
  return useDb().select().from(categoriesTable)
})

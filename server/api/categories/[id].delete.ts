import { and, eq } from 'drizzle-orm'
import { categories } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)

  const deletedItem = await useDb()
    .delete(categories)
    .where(and(eq(categories.id, Number(id))))
    .returning()
    .get()

  if (!deletedItem) {
    throw createError({
      statusCode: 404,
      message: 'Category not found',
    })
  }
})

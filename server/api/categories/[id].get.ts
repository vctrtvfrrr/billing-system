import { eq } from 'drizzle-orm'
import { categories } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)

  const category = await useDb()
    .select()
    .from(categories)
    .where(eq(categories.id, parseInt(id)))
    .limit(1)

  if (category.length === 0) {
    throw createError({
      statusCode: 404,
      message: 'Category not found',
    })
  }

  return category[0]
})

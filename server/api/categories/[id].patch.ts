import { eq } from 'drizzle-orm'
import { categories } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)
  const { label, type, icon, color } = await readBody(event)

  const category = await useDb()
    .update(categories)
    .set({ label, type, icon, color, updatedAt: new Date().toISOString() })
    .where(eq(categories.id, parseInt(id)))
    .returning()

  return category[0]
})

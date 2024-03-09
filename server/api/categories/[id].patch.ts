import { eq } from 'drizzle-orm'
import { categories } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)
  const { label, type, icon } = await readBody(event)

  const expense = await useDb()
    .update(categories)
    .set({ label, type, icon })
    .where(eq(categories.id, Number(id)))
    .returning()
    .get()

  return expense
})

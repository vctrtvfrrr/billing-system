import { eq } from 'drizzle-orm'
import { expenses } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)
  const { value, date, description } = await readBody(event)

  const expense = await useDb()
    .update(expenses)
    .set({
      value,
      date,
      description,
    })
    .where(eq(expenses.id, Number(id)))
    .returning()
    .get()

  return expense
})

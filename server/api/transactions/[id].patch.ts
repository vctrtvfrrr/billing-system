import { eq } from 'drizzle-orm'
import { transactions } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)
  const { value, date, description } = await readBody(event)

  const expense = await useDb()
    .update(transactions)
    .set({
      value,
      date,
      description,
    })
    .where(eq(transactions.id, Number(id)))
    .returning()
    .get()

  return expense
})

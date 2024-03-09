import { and, eq } from 'drizzle-orm'
import { transactions } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)

  const deletedExpense = await useDb()
    .delete(transactions)
    .where(and(eq(transactions.id, Number(id))))
    .returning()
    .get()

  if (!deletedExpense) {
    throw createError({
      statusCode: 404,
      message: 'Transaction not found',
    })
  }
})

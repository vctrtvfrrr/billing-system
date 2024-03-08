import { and, eq } from 'drizzle-orm'
import { expenses } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { id } = getRouterParams(event)

  const deletedExpense = await useDb()
    .delete(expenses)
    .where(and(eq(expenses.id, Number(id))))
    .returning()
    .get()

  if (!deletedExpense) {
    throw createError({
      statusCode: 404,
      message: 'Expense not found',
    })
  }

  return deletedExpense
})

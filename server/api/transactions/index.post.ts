import { transactions } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { accountId, value, date, description } = await readBody(event)

  const expense = await useDb()
    .insert(transactions)
    .values({
      accountId,
      value,
      date,
      description,
    })
    .returning()
    .get()

  return expense
})

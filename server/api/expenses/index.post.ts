import { expenses } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { value, date, description } = await readBody(event)

  const expense = await useDb()
    .insert(expenses)
    .values({
      value,
      date,
      description,
    })
    .returning()
    .get()

  return expense
})

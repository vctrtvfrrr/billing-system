import { transactions } from '~/server/database/schema'

export default eventHandler(() => {
  return useDb().select().from(transactions)
})

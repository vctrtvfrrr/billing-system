import { transactions as transactionsTable } from '~/server/database/schema'

export default eventHandler(() => {
  const transactions = useDb().select().from(transactionsTable)
  console.log(transactions)
  return transactions
})

import { desc, eq, sql } from 'drizzle-orm'
import { accounts, categories, transactions } from '~/server/database/schema'

export default eventHandler(getTransactions)

async function getTransactions() {
  return useDb()
    .select({
      id: transactions.id,
      type: transactions.type,
      status: transactions.status,
      value: transactions.value,
      date: transactions.date,
      description: transactions.description,
      account: sql`${accounts.label} as account`,
      category: {
        label: sql`${categories.label} as categoryLabel`,
        icon: sql`${categories.icon} as categoryIcon`,
        color: sql`${categories.color} as categoryColor`,
      },
    })
    .from(transactions)
    .leftJoin(accounts, eq(accounts.id, transactions.accountId))
    .leftJoin(categories, eq(categories.id, transactions.categoryId))
    .where(sql`${transactions.deletedAt} IS NULL`)
    .orderBy(desc(transactions.date), desc(transactions.id))
}

export type GetTransactions = Awaited<ReturnType<typeof getTransactions>>

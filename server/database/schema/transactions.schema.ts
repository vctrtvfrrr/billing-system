import { sql } from 'drizzle-orm'
import { integer, sqliteTable, text } from 'drizzle-orm/sqlite-core'
import { accounts, categories } from '.'
import { TransactionStatus, TransactionType } from '../../../types/enums.d'
import { deletedAt, id, timestamps } from '../../utils/dbFields'

export const transactions = sqliteTable('transactions', {
  id,
  accountId: integer('account_id', { mode: 'number' })
    .notNull()
    .references(() => accounts.id, { onDelete: 'restrict' }),
  type: text('type', { enum: [TransactionType.REVENUE, TransactionType.EXPENSES] }).default(
    TransactionType.EXPENSES
  ),
  status: text('status', { enum: [TransactionStatus.OPEN, TransactionStatus.PAID] }).default(
    TransactionStatus.OPEN
  ),
  value: integer('value', { mode: 'number' }).notNull(),
  date: text('date').default(sql`CURRENT_TIMESTAMP`),
  description: text('description'),
  categoryId: integer('category_id', { mode: 'number' }).references(() => categories.id, {
    onDelete: 'set null',
  }),
  ...timestamps,
  deletedAt,
})

export type Transaction = typeof transactions.$inferSelect
export type NewTransaction = typeof transactions.$inferInsert
export type EditTransaction = Partial<Transaction>

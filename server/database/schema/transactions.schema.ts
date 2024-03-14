import { sql } from 'drizzle-orm'
import { integer, sqliteTable, text } from 'drizzle-orm/sqlite-core'
import { TransactionType } from '../../../utils/types'
import { id, timestamps } from '../../utils/dbFields'
import { accounts, categories } from '.'

export const transactions = sqliteTable('transactions', {
  id,
  accountId: integer('account_id', { mode: 'number' })
    .notNull()
    .references(() => accounts.id, { onDelete: 'restrict' }),
  type: text('type', { enum: [TransactionType.REVENUE, TransactionType.EXPENSES] }),
  value: integer('value', { mode: 'number' }).notNull(),
  date: text('date').default(sql`CURRENT_TIMESTAMP`),
  description: text('description'),
  categoryId: integer('category_id', { mode: 'number' }).references(() => categories.id, {
    onDelete: 'set null',
  }),
  ...timestamps,
})
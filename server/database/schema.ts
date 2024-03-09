import { sql } from 'drizzle-orm'
import { sqliteTable, text, integer } from 'drizzle-orm/sqlite-core'
import { id, timestamps } from '../utils/dbFields'
import { TransactionType } from '../../types'

export const categories = sqliteTable('categories', {
  id,
  type: text('type', { enum: [TransactionType.REVENUE, TransactionType.EXPENSES] }).notNull(),
  label: text('label', { length: 50 }).notNull(),
  icon: text('icon', { length: 50 }).notNull(),
  ...timestamps,
})

export const transactions = sqliteTable('transactions', {
  id,
  type: text('type', { enum: [TransactionType.REVENUE, TransactionType.EXPENSES] }),
  value: integer('value').notNull(),
  date: text('date').default(sql`CURRENT_TIMESTAMP`),
  description: text('description'),
  ...timestamps,
})

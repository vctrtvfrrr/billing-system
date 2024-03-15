import { sqliteTable, text } from 'drizzle-orm/sqlite-core'
import { TransactionType } from '../../../utils/types'
import { id, timestamps } from '../../utils/dbFields'

export const categories = sqliteTable('categories', {
  id,
  type: text('type', { enum: [TransactionType.REVENUE, TransactionType.EXPENSES] }).notNull(),
  label: text('label', { length: 50 }).notNull(),
  icon: text('icon', { length: 50 }).notNull(),
  ...timestamps,
})

export type Category = typeof categories.$inferSelect
export type NewCategory = typeof categories.$inferInsert

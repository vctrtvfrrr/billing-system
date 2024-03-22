import { sqliteTable, text } from 'drizzle-orm/sqlite-core'
import { TransactionType } from '../../../types/enums.d'
import { deletedAt, id, timestamps } from '../../utils/dbFields'

export const categories = sqliteTable('categories', {
  id,
  type: text('type', { enum: [TransactionType.REVENUE, TransactionType.EXPENSES] }).notNull(),
  label: text('label', { length: 50 }).notNull(),
  icon: text('icon', { length: 50 }).notNull(),
  color: text('color', { length: 7 }).notNull(),
  ...timestamps,
  deletedAt,
})

export type Category = typeof categories.$inferSelect
export type NewCategory = typeof categories.$inferInsert
export type EditCategory = Partial<Category>

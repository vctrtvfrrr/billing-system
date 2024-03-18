import { integer, sqliteTable, text } from 'drizzle-orm/sqlite-core'
import { id, timestamps } from '../../utils/dbFields'

export const accounts = sqliteTable('accounts', {
  id,
  label: text('label', { length: 50 }).notNull(),
  openingBalance: integer('opening_balance', { mode: 'number' }).notNull(),
  color: text('color', { length: 7 }).notNull(),
  ...timestamps,
})

export type Account = typeof accounts.$inferSelect
export type NewAccount = typeof accounts.$inferInsert
export type EditAccount = Partial<Account>

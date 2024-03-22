import { integer, sqliteTable, text } from 'drizzle-orm/sqlite-core'
import { deletedAt, id, timestamps } from '../../utils/dbFields'
import { accounts } from '.'

export const creditCards = sqliteTable('credit_cards', {
  id,
  label: text('label', { length: 50 }).notNull(),
  limit: integer('limit', { mode: 'number' }).notNull(),
  accountId: integer('account_id', { mode: 'number' })
    .notNull()
    .references(() => accounts.id, { onDelete: 'restrict' }),
  closingDay: integer('closing_day', { mode: 'number' }).notNull(),
  dueDay: integer('due_day', { mode: 'number' }).notNull(),
  ...timestamps,
  deletedAt,
})

export type CreditCard = typeof creditCards.$inferSelect
export type NewCreditCard = typeof creditCards.$inferInsert
export type EditCreditCard = Partial<CreditCard>

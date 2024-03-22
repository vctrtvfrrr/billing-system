import { integer, sqliteTable, text } from 'drizzle-orm/sqlite-core'
import { InvoiceStatus } from '../../../types/enums.d'
import { deletedAt, id, timestamps } from '../../utils/dbFields'
import { creditCards } from './creditCards.schema'

export const invoices = sqliteTable('invoices', {
  id,
  creditCardId: integer('credit_card_id', { mode: 'number' })
    .notNull()
    .references(() => creditCards.id, { onDelete: 'restrict' }),
  reference: text('reference', { length: 7 }).notNull(),
  amount: integer('limit', { mode: 'number' }).notNull(),
  status: text('status', { enum: [InvoiceStatus.OPEN, InvoiceStatus.CLOSED] }).default(
    InvoiceStatus.OPEN
  ),
  closingDay: integer('closing_day', { mode: 'number' }).notNull(),
  dueDay: integer('due_day', { mode: 'number' }).notNull(),
  ...timestamps,
  deletedAt,
})

export type Invoice = typeof invoices.$inferSelect
export type NewInvoice = typeof invoices.$inferInsert
export type EditInvoice = Partial<Invoice>

import { sql } from 'drizzle-orm'
import { sqliteTable, text, integer } from 'drizzle-orm/sqlite-core'
import { id, timestamps } from '../utils/dbFields'

export const income = sqliteTable('income', {
  id,
  value: integer('value').notNull(),
  date: text('date').default(sql`CURRENT_TIMESTAMP`),
  description: text('description'),
  ...timestamps,
})

export const expenses = sqliteTable('expenses', {
  id,
  value: integer('value').notNull(),
  date: text('date').default(sql`CURRENT_TIMESTAMP`),
  description: text('description'),
  ...timestamps,
})

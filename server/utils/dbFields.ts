import { sql } from 'drizzle-orm'
import * as sqlite from 'drizzle-orm/sqlite-core'

export const id = sqlite.integer('id', { mode: 'number' }).primaryKey({ autoIncrement: true })

export const createdAt = sqlite
  .text('created_at')
  .notNull()
  .default(sql`CURRENT_TIMESTAMP`)

export const updatedAt = sqlite
  .text('updated_at')
  .notNull()
  .default(sql`CURRENT_TIMESTAMP`)

export const deletedAt = sqlite.text('deleted_at')

export const timestamps = {
  createdAt,
  updatedAt,
}

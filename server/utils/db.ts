import { Database } from 'bun:sqlite'
import { BunSQLiteDatabase, drizzle } from 'drizzle-orm/bun-sqlite'
import * as schema from '../database/schema'

let sqlite: Database | null
let db: BunSQLiteDatabase<typeof schema> | null

export function useDb() {
  if (db) return db
  const config = useRuntimeConfig()
  sqlite = new Database(config.db)
  db = drizzle(sqlite, { schema })
  return db
}

export const tables = schema

export type Category = typeof schema.categories.$inferSelect
export type CategoryInsert = typeof schema.categories.$inferInsert
export type Transaction = typeof schema.transactions.$inferSelect
export type TransactionInsert = typeof schema.transactions.$inferInsert

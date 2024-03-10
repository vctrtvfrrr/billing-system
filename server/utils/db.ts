import { Database } from 'bun:sqlite'
import { drizzle } from 'drizzle-orm/bun-sqlite'
import * as schema from '../database/schema'

export const tables = schema

export function useDb() {
  const sqlite = new Database('sqlite.db')
  return drizzle(sqlite, { schema })
}

export type Category = typeof schema.categories.$inferSelect
export type Transaction = typeof schema.transactions.$inferSelect

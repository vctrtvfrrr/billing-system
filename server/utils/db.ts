import { Database } from 'bun:sqlite'
import { drizzle } from 'drizzle-orm/bun-sqlite'
import * as schema from '../database/schema'

export function useDb() {
  const sqlite = new Database('sqlite.db')
  return drizzle(sqlite, { schema })
}

import { Database } from 'bun:sqlite'
import type { BunSQLiteDatabase } from 'drizzle-orm/bun-sqlite'
import { drizzle } from 'drizzle-orm/bun-sqlite'
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

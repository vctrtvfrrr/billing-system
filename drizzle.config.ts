import 'dotenv/config'
import { defineConfig } from 'drizzle-kit'
import { join } from 'path'

export default defineConfig({
  schema: './server/database/schema/index.ts',
  out: './server/database/migrations',
  driver: 'better-sqlite',
  dbCredentials: {
    url: join(__dirname, process.env.DATABASE_URL || 'sqlite.db'),
  },
  verbose: true,
  strict: true,
})

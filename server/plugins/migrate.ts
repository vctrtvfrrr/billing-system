import { migrate } from 'drizzle-orm/bun-sqlite/migrator'

export default defineNitroPlugin(async () => {
  if (!import.meta.dev) return

  migrate(useDb(), { migrationsFolder: 'server/database/migrations' })
})

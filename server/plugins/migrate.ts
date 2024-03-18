import { migrate } from 'drizzle-orm/bun-sqlite/migrator'
import { join } from 'path'

export default defineNitroPlugin(async () => {
  try {
    const config = useRuntimeConfig()
    await migrate(useDb(), { migrationsFolder: join(config.rootDir, 'server/database/migrations') })
    console.info('schema and db migrated')
  } catch (err) {
    if (err instanceof Error) {
      console.error(err.message)
    } else {
      throw err
    }
  }
})

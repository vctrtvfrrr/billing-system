import { useLogger } from '@nuxt/kit'
import { migrate } from 'drizzle-orm/bun-sqlite/migrator'

export default defineNitroPlugin(async () => {
  const logger = useLogger('drizzle')

  try {
    await migrate(useDb(), { migrationsFolder: '../database/migrations' })
    logger.success('schema and db migrated')
  } catch (err) {
    if (err instanceof Error) {
      logger.error(err.message)
    } else {
      throw err
    }
  }
})

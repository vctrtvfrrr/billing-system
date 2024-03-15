import { migrate } from 'drizzle-orm/bun-sqlite/migrator'

export default defineNitroPlugin(async () => {
  try {
    await migrate(useDb(), { migrationsFolder: '../database/migrations' })
    console.info('schema and db migrated')
  } catch (err) {
    if (err instanceof Error) {
      console.error(err.message)
    } else {
      throw err
    }
  }
})

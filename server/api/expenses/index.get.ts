import { expenses } from '~/server/database/schema'

export default eventHandler(() => {
  return useDb().select().from(expenses)
})

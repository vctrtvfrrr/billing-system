import { categories } from '~/server/database/schema'

export default eventHandler(async (event) => {
  const { label, type, icon } = await readBody(event)

  try {
    const expense = await useDb().insert(categories).values({ label, type, icon }).returning()
    return expense[0]
  } catch (err) {
    throw createError({
      statusCode: 500,
      message: 'Não foi possível cadastrar a categoria.',
    })
  }
})

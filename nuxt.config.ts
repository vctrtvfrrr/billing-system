import { join } from 'path'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: ['@nuxt/ui', '@pinia/nuxt'],
  runtimeConfig: {
    db: join(import.meta.dir, './server/database/sqlite.db'),
  },
})

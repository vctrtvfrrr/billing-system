import { join } from 'path'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: ['@nuxt/ui', '@pinia/nuxt'],
  runtimeConfig: {
    db: join(__dirname, process.env.DATABASE_URL || 'sqlite.db'),
  },
})

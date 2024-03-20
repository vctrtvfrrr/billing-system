// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: ['@nuxt/ui', '@pinia/nuxt'],
  runtimeConfig: {
    rootDir: __dirname,
    db: process.env.DATABASE_URL || 'sqlite.db',
  },
  tailwindcss: {
    viewer: false,
  },
  ui: {
    icons: ['mdi', 'heroicons'],
  },
})

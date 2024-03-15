import { defineStore } from 'pinia'
import type { Category, NewCategory } from '~/server/database/schema/categories.schema'

export const useCategoriesStore = defineStore('categories', () => {
  const categories = ref<Category[]>([])

  async function fetchCategories() {
    categories.value = await $fetch<Category[]>('/api/categories')
  }

  async function storeCategory(categoryData: NewCategory) {
    console.log(categoryData)

    const category = await $fetch('/api/categories', {
      method: 'POST',
      body: categoryData,
    })

    categories.value.push(category)
  }

  return { categories, fetchCategories, storeCategory }
})

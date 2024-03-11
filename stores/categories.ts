import { defineStore } from 'pinia'
import type { Category, CategoryInsert } from '~/server/utils/db'

export const useCategoriesStore = defineStore('categories', () => {
  const categories = ref<Category[]>([])

  async function fetchCategories() {
    categories.value = await $fetch<Category[]>('/api/categories')
  }

  async function storeCategory(categoryData: CategoryInsert) {
    console.log(categoryData)

    const category = await $fetch('/api/categories', {
      method: 'POST',
      body: categoryData,
    })

    categories.value.push(category)
  }

  return { categories, fetchCategories, storeCategory }
})

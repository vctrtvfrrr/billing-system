import { defineStore } from 'pinia'
import type {
  Category,
  EditCategory,
  NewCategory,
} from '~/server/database/schema/categories.schema'

export const useCategoriesStore = defineStore('categories', () => {
  const categories = ref<Category[]>([])

  async function fetchCategories() {
    categories.value = await $fetch<Category[]>('/api/categories')
  }

  async function storeCategory(categoryData: NewCategory) {
    const category = await $fetch('/api/categories', {
      method: 'POST',
      body: categoryData,
    })

    categories.value.push(category)
  }

  async function updateCategory(categoryData: EditCategory) {
    const category = await $fetch(`/api/categories/${categoryData.id}`, {
      method: 'PATCH',
      body: categoryData,
    })

    const index = categories.value.findIndex((i) => i.id === category.id)
    if (index >= 0) {
      categories.value[index] = category
    } else {
      categories.value.push(category)
    }
  }

  async function deleteCategory(categoryId: number) {
    await $fetch(`/api/categories/${categoryId}`, { method: 'DELETE' })

    const index = categories.value.findIndex((i) => i.id === categoryId)
    if (index >= 0) categories.value.splice(index, 1)
  }

  return { categories, fetchCategories, storeCategory, updateCategory, deleteCategory }
})

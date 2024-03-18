<script setup lang="ts">
import type { Category } from '~/server/database/schema/categories.schema'

const store = useCategoriesStore()
const toast = useToast()

await useAsyncData('categories', () => store.fetchCategories())

const { categories } = storeToRefs(store)

const columns = [
  { key: 'type', label: 'Tipo' },
  { key: 'icon', label: 'Ícone' },
  { key: 'label', label: 'Categoria' },
  { key: 'actions' },
]

const isLoading = ref(false)
const isFormModalOpen = ref(false)
const currentCategory = ref<Category | null>()

const items = (row: Category) => [
  [
    {
      label: 'Editar',
      icon: 'i-mdi-file-edit-outline',
      async click() {
        try {
          isLoading.value = true

          const category = await $fetch(`/api/categories/${row.id}`)
          currentCategory.value = category

          isFormModalOpen.value = true
        } catch (err) {
          console.log(err)
        } finally {
          isLoading.value = false
        }
      },
    },
  ],
  [
    {
      label: 'Apagar',
      icon: 'i-mdi-delete-outline',
      click: () => deleteItem(row.id),
    },
  ],
]

async function deleteItem(itemId: number) {
  if (!confirm('Tem certeza que deseja remover esta categoria?')) return

  try {
    await store.deleteCategory(itemId)
  } catch (err) {
    if (err instanceof Error) {
      toast.add({
        color: 'red',
        title: 'Ocorreu um erro',
        icon: 'i-heroicons-x-circle',
        description: err.message,
      })
    }
  }
}
</script>

<template>
  <UTable :columns="columns" :rows="categories">
    <template #icon-data="{ row }">
      <UBadge :style="`background-color: ${row.color}`">
        <UIcon :name="row.icon" class="text-white" dynamic />
      </UBadge>
    </template>

    <template #actions-data="{ row }">
      <UDropdown :items="items(row)">
        <UButton color="gray" variant="ghost" icon="i-heroicons-ellipsis-vertical" />
      </UDropdown>
    </template>
  </UTable>

  <Teleport to="body">
    <UModal v-model="isFormModalOpen">
      <CategoriesForm :category="currentCategory" @close="isFormModalOpen = false" />
    </UModal>

    <PageLoading v-show="isLoading" />
  </Teleport>
</template>

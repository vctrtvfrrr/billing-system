<script setup lang="ts">
const { data: categories, refresh } = await useAsyncData('categories', () =>
  $fetch('/api/categories')
)
const columns = [
  { key: 'type', label: 'Tipo' },
  { key: 'icon', label: 'Ícone' },
  { key: 'label', label: 'Categoria' },
  { key: 'actions' },
]
const items = (row: Category) => [
  [
    {
      label: 'Editar',
      icon: 'i-heroicons-pencil-square-20-solid',
      click: () => console.log('Edit', row.id),
    },
  ],
  [
    {
      label: 'Apagar',
      icon: 'i-heroicons-trash-20-solid',
      click: () => deleteItem(row.id),
    },
  ],
]

async function deleteItem(itemId: number) {
  if (!confirm('Tem certeza que deseja remover esta categoria?')) return

  try {
    await $fetch(`/api/categories/${itemId}`, { method: 'DELETE' })
    await refresh()
  } catch (err) {
    console.log(err)
  }
}
</script>

<template>
  <UTable :columns="columns" :rows="categories">
    <template #actions-data="{ row }">
      <UDropdown :items="items(row)">
        <UButton color="gray" variant="ghost" icon="i-heroicons-ellipsis-horizontal-20-solid" />
      </UDropdown>
    </template>
  </UTable>
</template>

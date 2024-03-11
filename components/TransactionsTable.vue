<script setup lang="ts">
const store = useTransactionsStore()

await useAsyncData('transactions', () => store.fetchTransactions())

const { transactions } = storeToRefs(store)

const columns = [
  { key: 'type', label: 'Tipo' },
  { key: 'date', label: 'Data' },
  { key: 'value', label: 'Valor' },
  { key: 'description', label: 'Descrição' },
  { key: 'actions' },
]
const items = (row: Transaction) => [
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
    },
  ],
]
</script>

<template>
  <UTable :columns="columns" :rows="transactions">
    <template #actions-data="{ row }">
      <UDropdown :items="items(row)">
        <UButton color="gray" variant="ghost" icon="i-heroicons-ellipsis-horizontal-20-solid" />
      </UDropdown>
    </template>
  </UTable>
</template>

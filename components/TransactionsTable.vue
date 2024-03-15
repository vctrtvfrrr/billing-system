<script setup lang="ts">
import type { Transaction } from '~/server/database/schema/transactions.schema'

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

function generateActionsList(transaction: Transaction) {
  return [
    [
      {
        label: 'Editar',
        icon: 'i-heroicons-pencil-square-20-solid',
        click: () => console.log('Edit', transaction.id),
      },
    ],
    [
      {
        label: 'Apagar',
        icon: 'i-heroicons-trash-20-solid',
        click: () => console.log('Delete', transaction.id),
      },
    ],
  ]
}
</script>

<template>
  <UTable :columns="columns" :rows="transactions">
    <template #actions-data="{ row }">
      <UDropdown :items="generateActionsList(row)">
        <UButton color="gray" variant="ghost" icon="i-heroicons-ellipsis-horizontal-20-solid" />
      </UDropdown>
    </template>
  </UTable>
</template>

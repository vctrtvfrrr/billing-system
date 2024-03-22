<script setup lang="ts">
import type { Transaction } from '~/server/database/schema/transactions.schema'
import { TransactionStatus, TransactionType } from '~/types/enums.d'

const store = useTransactionsStore()
const toast = useToast()

await useAsyncData('transactions', () => store.fetchTransactions())

const { formattedTransactions, isLoading } = storeToRefs(store)

const isFormModalOpen = ref(false)
const currentTransaction = ref<Transaction | null>()

const columns = [
  { key: 'status', label: 'Situação' },
  { key: 'date', label: 'Data' },
  { key: 'description', label: 'Descrição' },
  { key: 'category', label: 'Categoria' },
  { key: 'account', label: 'Conta' },
  { key: 'value', label: 'Valor', class: 'text-right' },
  { key: 'actions' },
]

async function deleteItem(itemId: number) {
  if (!confirm('Tem certeza que deseja remover esta transação?')) return

  try {
    await store.deleteTransaction(itemId)
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
  <UTable
    :columns="columns"
    :rows="formattedTransactions"
    :loading="isLoading"
    :ui="{ td: { padding: 'px-4 py-0' } }"
  >
    <template #status-data="{ row }">
      <UIcon
        v-if="row.status === TransactionStatus.OPEN"
        name="i-heroicons-x-circle"
        class="text-red-500"
      />
      <UIcon
        v-if="row.status === TransactionStatus.PAID"
        name="i-heroicons-check-circle"
        class="text-green-500"
      />
    </template>

    <template #value-data="{ row }">
      <span :class="row.type === TransactionType.REVENUE ? 'text-green-500' : 'text-red-500'">{{
        row.value.value
      }}</span>
    </template>

    <template #category-data="{ row }">
      <UIcon :name="row.category.icon" :style="`color: ${row.category.color}`" dynamic />
      {{ row.category.label }}
    </template>

    <template #actions-data="{ row }">
      <UTooltip text="Editar">
        <UButton
          color="gray"
          variant="link"
          icon="i-heroicons-pencil"
          size="xs"
          @click="(currentTransaction = row), (isFormModalOpen = true)"
        />
      </UTooltip>
      <UTooltip text="Apagar">
        <UButton
          color="red"
          variant="link"
          icon="i-heroicons-trash"
          size="xs"
          @click="deleteItem(row.id)"
        />
      </UTooltip>
    </template>
  </UTable>

  <Teleport to="body">
    <UModal v-model="isFormModalOpen">
      <TransactionsForm
        :transaction="currentTransaction"
        @close="(isFormModalOpen = false), (currentTransaction = null)"
      />
    </UModal>

    <PageLoading v-show="store.isLoading" />
  </Teleport>
</template>

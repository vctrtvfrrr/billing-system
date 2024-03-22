import { format } from 'date-fns'
import { defineStore } from 'pinia'
import type { GetTransactions } from '~/server/api/transactions/index.get'
import type { NewTransaction } from '~/server/database/schema/transactions.schema'

export const useTransactionsStore = defineStore('transactions', () => {
  const isLoading = ref(false)
  const transactions = ref<GetTransactions>([])

  async function fetchTransactions() {
    isLoading.value = true
    const { data } = await useFetch('/api/transactions')
    if (data.value !== null) transactions.value = data.value
    isLoading.value = false
  }

  async function storeTransaction(transactionData: NewTransaction) {
    isLoading.value = true

    const transaction = await $fetch('/api/transactions', {
      method: 'POST',
      body: transactionData,
    })

    transactions.value.push(transaction)

    isLoading.value = false
  }

  const formattedTransactions = computed(() => {
    return transactions.value
      .sort((a, b) => {
        if (a.date && b.date) {
          const x = new Date(a.date)
          const y = new Date(b.date)

          if (x < y) return 1
          if (x > y) return -1
        }

        return (a.id - b.id) * -1
      })
      .map((transaction) => {
        const numberFormatter = new Intl.NumberFormat('pt-BR', {
          style: 'currency',
          currency: 'BRL',
        })

        return {
          ...transaction,
          date: transaction.date ? format(new Date(transaction.date), 'dd/MM/yyyy') : '-',
          value: { value: numberFormatter.format(transaction.value / 100), class: 'text-right' },
          actions: { class: 'text-right' },
        }
      })
  })

  return {
    isLoading,
    transactions,
    fetchTransactions,
    storeTransaction,
    formattedTransactions,
  }
})

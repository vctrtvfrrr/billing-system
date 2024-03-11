import { defineStore } from 'pinia'
import type { Transaction, TransactionInsert } from '~/server/utils/db'

export const useTransactionsStore = defineStore('transactions', () => {
  const transactions = ref<Transaction[]>([])

  async function fetchTransactions() {
    transactions.value = await $fetch<Transaction[]>('/api/transactions')
  }

  async function storeTransaction(transactionData: TransactionInsert) {
    console.log(transactionData)

    const transaction = await $fetch('/api/transactions', {
      method: 'POST',
      body: transactionData,
    })

    transactions.value.push(transaction)
  }

  return { transactions, fetchTransactions, storeTransaction }
})

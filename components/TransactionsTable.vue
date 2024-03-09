<script setup lang="ts">
const { data: transactions } = await useAsyncData('transactions', () => $fetch('/api/transactions'))
</script>

<template>
  <table>
    <thead>
      <tr>
        <th>Data</th>
        <th>Valor</th>
        <th>Descrição</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="transaction of transactions" :key="transaction.id">
        <td>{{ transaction.type }}</td>
        <td>{{ transaction.date }}</td>
        <td>{{ transaction.value }}</td>
        <td>{{ transaction.description }}</td>
      </tr>
    </tbody>
  </table>
</template>

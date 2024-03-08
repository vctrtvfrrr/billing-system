<script setup lang="ts">
const { data: expenses } = await useAsyncData('expenses', () => $fetch('/api/expenses'))
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
      <tr v-for="expense of expenses" :key="expense.id">
        <td>{{ expense.date }}</td>
        <td>{{ expense.value }}</td>
        <td>{{ expense.description }}</td>
      </tr>
    </tbody>
  </table>
</template>

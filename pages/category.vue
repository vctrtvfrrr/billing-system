<script setup lang="ts">
import { TransactionType } from '~/types'

const { data: categories } = await useAsyncData('categories', () => $fetch('/api/categories'))

const transactionTypes = Object.values(TransactionType)
const state = reactive({
  label: '',
  type: '',
  icon: '',
})

async function onSubmit() {
  const data = await $fetch('/api/categories', {
    method: 'POST',
    body: state,
  })
  console.log(data)
}

async function deleteCategory(categoryId: number) {
  if (!confirm('Tem certeza que deseja remover esta categoria?')) return

  try {
    await $fetch(`/api/categories/${categoryId}`, { method: 'DELETE' })
  } catch (err) {
    console.log(err)
  }
}
</script>

<template>
  <div>
    <h1>Cadastrar categoria</h1>

    <form @submit.prevent="onSubmit">
      <div>
        <label for="label">Label:</label>
        <input v-model="state.label" type="text" name="label" />
      </div>

      <div>
        <label v-for="item in transactionTypes" :key="item"
          ><input v-model="state.type" type="radio" :value="item" />{{ item }}</label
        >
      </div>

      <div>
        <label for="icon">Ícone:</label>
        <input v-model="state.icon" type="text" name="icon" />
      </div>

      <button type="submit">Cadastrar</button>
    </form>

    <hr />

    <table>
      <thead>
        <tr>
          <th>Data</th>
          <th>Valor</th>
          <th>Descrição</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category of categories" :key="category.id">
          <td>{{ category.type }}</td>
          <td>{{ category.label }}</td>
          <td>{{ category.icon }}</td>
          <td><button type="button" @click="deleteCategory(category.id)">apagar</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

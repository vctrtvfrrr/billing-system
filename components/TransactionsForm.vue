<script lang="ts" setup>
defineEmits(['close'])

const store = useTransactionsStore()

const transactionTypes = [
  {
    value: TransactionType.REVENUE,
    label: 'Receitas',
  },
  {
    value: TransactionType.EXPENSES,
    label: 'Despesas',
  },
]

const state = reactive({
  value: '',
  date: '',
  type: TransactionType.EXPENSES,
  category: '',
  description: '',
})

async function onSubmit() {
  await store.storeTransaction(state)
}
</script>

<template>
  <UForm :state="state" @submit="onSubmit">
    <UCard>
      <template #header>
        <h3 class="text-xl font-bold">Cadastrar despesa</h3>
      </template>

      <div class="space-y-4">
        <UFormGroup label="Valor" name="value">
          <UInput type="number" name="value" />
        </UFormGroup>

        <UFormGroup label="Data" name="date">
          <UInput type="date" name="date" />
        </UFormGroup>

        <UFormGroup>
          <URadioGroup legend="Tipo" :options="transactionTypes" />
        </UFormGroup>

        <UFormGroup label="Catergoria" name="category">
          <USelect name="category" :options="[]" placeholder="Selecione..." />
        </UFormGroup>

        <UFormGroup label="Descrição" name="description">
          <UTextarea name="description" />
        </UFormGroup>
      </div>

      <template #footer>
        <div class="flex justify-between">
          <UButton type="button" color="gray" label="Fechar" @click="$emit('close')" />
          <UButton type="submit" label="Cadastrar" />
        </div>
      </template>
    </UCard>
  </UForm>
</template>

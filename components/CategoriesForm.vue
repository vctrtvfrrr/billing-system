<script lang="ts" setup>
defineEmits(['close'])

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
  label: '',
  type: TransactionType.EXPENSES,
  icon: '',
})

async function onSubmit() {
  const data = await $fetch('/api/categories', {
    method: 'POST',
    body: state,
  })
  console.log(data)
}
</script>

<template>
  <UForm :state="state" @submit="onSubmit">
    <UCard>
      <template #header>
        <h3 class="text-xl font-bold">Cadastrar categoria</h3>
      </template>

      <div class="space-y-4">
        <UFormGroup label="Label" name="label">
          <UInput type="text" name="label" />
        </UFormGroup>

        <UFormGroup>
          <URadioGroup legend="Tipo" :options="transactionTypes" />
        </UFormGroup>

        <UFormGroup label="Ícone" name="icon">
          <UInput type="text" name="icon" />
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
~/server/utils/types

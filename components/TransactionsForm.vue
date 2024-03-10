<script lang="ts" setup>
defineEmits(['close'])

const state = reactive({
  value: '',
  category: '',
  description: '',
})
</script>

<template>
  <UForm :state="state">
    <UCard>
      <template #header>
        <h3 class="text-xl font-bold">Cadastrar despesa</h3>
      </template>

      <div class="space-y-4">
        <UFormGroup label="Valor" name="value">
          <UInput type="number" name="value" />
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

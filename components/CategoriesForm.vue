<script lang="ts" setup>
import type { Category } from '~/server/database/schema/categories.schema'

const emit = defineEmits(['close'])

const props = defineProps<{ category?: Category | null }>()
const store = useCategoriesStore()
const toast = useToast()

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
  label: props?.category?.label || '',
  type: props?.category?.type || TransactionType.EXPENSES,
  icon: props?.category?.icon || '',
  color: props?.category?.color || '#000000',
})

async function onSubmit() {
  try {
    if (props.category) {
      store.updateCategory({ ...state, id: props.category?.id })
    } else {
      store.storeCategory(state)
    }

    toast.add({
      title: 'Sucesso',
      icon: 'i-heroicons-check-circle',
      description: 'Categoria salva com sucesso.',
    })

    emit('close')
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
  <UForm :state="state" @submit="onSubmit">
    <UCard>
      <template #header>
        <h3 class="text-xl font-bold">
          {{
            props.category ? `Editando a categoria ${props.category.label}` : 'Cadastrar categoria'
          }}
        </h3>
      </template>

      <div class="space-y-4">
        <UFormGroup label="Label" name="label">
          <UInput v-model="state.label" type="text" name="label" />
        </UFormGroup>

        <UFormGroup>
          <URadioGroup v-model="state.type" legend="Tipo" :options="transactionTypes" />
        </UFormGroup>

        <UFormGroup label="Ícone" name="icon">
          <UInput v-model="state.icon" type="text" name="icon" />
        </UFormGroup>

        <UFormGroup label="Cor" name="color">
          <UInput v-model="state.color" type="color" name="color" />
        </UFormGroup>
      </div>

      <template #footer>
        <div class="flex justify-between">
          <UButton type="button" color="gray" label="Fechar" @click="$emit('close')" />
          <UButton type="submit" :label="props.category ? 'Editar' : 'Cadastrar'" />
        </div>
      </template>
    </UCard>
  </UForm>
</template>

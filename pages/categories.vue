<script lang="ts" setup>
const isFormModalOpen = ref(false)
</script>

<template>
  <UCard>
    <template #header>
      <div class="flex justify-between">
        <h2 class="text-xl font-bold">Categorias</h2>

        <div class="space-x-2">
          <UButton label="Nova categoria" @click="isFormModalOpen = true" />

          <Teleport to="body">
            <UModal v-model="isFormModalOpen">
              <CategoriesForm @close="isFormModalOpen = false" />
            </UModal>
          </Teleport>
        </div>
      </div>
    </template>

    <CategoriesTable />
  </UCard>
</template>

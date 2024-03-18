<script lang="ts" setup></script>

<template>
  <header
    class="sticky top-0 z-40 -mb-px flex w-full border-b border-gray-200 bg-white/75 backdrop-blur dark:border-gray-800 dark:bg-zinc-800/75"
  >
    <div
      class="flex flex-grow items-center justify-between px-4 py-4 drop-shadow-sm md:px-6 2xl:px-11"
    >
      <div class="flex items-center gap-2 sm:gap-4">
        <NuxtLink class="block flex-shrink-0" to="/">
          <UIcon name="i-heroicons-banknotes" />
        </NuxtLink>
      </div>

      <div class="flex items-center gap-3 sm:gap-7">
        <ul class="flex items-center gap-2 sm:gap-4">
          <li>
            <NuxtLink to="/">Transações</NuxtLink>
          </li>
          <li>
            <NuxtLink to="/categories">Categorias</NuxtLink>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

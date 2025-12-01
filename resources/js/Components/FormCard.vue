<template>
  <div
    class="bg-white shadow-md rounded-xl p-6 sm:p-8"
  >
    <!-- Titre -->
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
      <slot name="title" />
    </h2>

    <!-- Contenu du formulaire -->
    <form @submit.prevent="$emit('submit')" class="space-y-5 overflow-auto max-h-[400px] pr-2">
      <slot />
    </form>

    <!-- Footer (boutons, actions) -->
    <div class="mt-6">
      <slot name="actions" />
    </div>
  </div>
</template>

<script setup>
defineProps({
  // Si un jour tu veux ajouter des options
})
</script>

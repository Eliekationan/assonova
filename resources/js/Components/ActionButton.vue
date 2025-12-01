<!-- ActionButtons.vue -->
<template>
  <div class="flex gap-2">
    <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
      Éditer
    </button>
    <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
      Supprimer
    </button>
  </div>
</template>

<script setup>
defineProps({ row: Object })
</script>

<!-- ActifBadge.vue -->
<template>
  <span
    :class="[
      row.actif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800',
      'px-2 py-1 rounded-full text-xs font-semibold'
    ]"
  >
    {{ row.actif ? 'Actif' : 'Inactif' }}
  </span>
</template>

<script setup>
defineProps({
  row: Object
})
</script>

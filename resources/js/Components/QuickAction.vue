<template>
  <button class="w-full text-left bg-white p-4 rounded-xl border border-gray-100 flex items-center gap-4 shadow-sm">
    <div class="w-10 h-10 flex items-center justify-center rounded-md" :style="{ background: '#EAB308' }">
      <slot name="icon">★</slot>
    </div>
    <div class="text-sm">{{ label }}</div>
  </button>
</template>

<script>
export default {
  props: { label: String }
}
</script>

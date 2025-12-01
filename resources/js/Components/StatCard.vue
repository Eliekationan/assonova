<template>
  <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="text-2xl font-bold text-[#0f1724]">{{ value }}</div>
    <div class="text-gray-500 mt-2">{{ label }}</div>
  </div>
</template>

<script>
export default {
  props: {
    value: { type: [String, Number], required: true },
    label: { type: String, required: true }
  }
}
</script>

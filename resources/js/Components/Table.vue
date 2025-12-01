<template>
  <div class="p-4 pb-24 md:pb-6">
    <div class="hidden md:block overflow-x-auto">
      <!-- Tableau desktop -->
      <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
          <tr>
            <th v-for="col in columns" :key="col.key" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">
              {{ col.label }}
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <tr v-for="(row, rowIndex) in data" :key="row[rowKey]" class="hover:bg-gray-50 transition-colors">
            <td v-for="col in columns" :key="col.key" class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
              <component v-if="col.render" :is="col.render" :row="row" :rowIndex="rowIndex" />
              <span v-else>{{ row[col.key] }}</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Tableau mobile (stacked) -->
    <div class="md:hidden space-y-4">
      <div v-for="(row, rowIndex) in data" :key="row[rowKey]" class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div v-for="col in columns" :key="col.key" class="flex justify-between py-1">
          <span class="font-semibold text-gray-700">{{ col.label }}</span>
          <span class="text-gray-700">
            <component
                v-if="col.render"
                :is="col.render"
                :row="row"
                :rowIndex="rowIndex"
                />
            <!-- <component v-if="col.render" :is="col.render" :row="row" :rowIndex="rowIndex" /> -->
            <span v-else>{{ row[col.key] }}</span>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// import ActifBadge from '@/Components/ActifBadge.vue'
// import ActionButtons from '@/Components/ActionButtons.vue'
defineProps({
  columns: { type: Array, required: true },
  data: { type: Array, required: true },
  rowKey: { type: String, default: 'id' }
})
</script>

<style scoped>
/* Tout géré avec Tailwind, pas de styles supplémentaires */
</style>

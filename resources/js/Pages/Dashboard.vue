<!-- <script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template> -->


<template>
  <AuthenticatedLayout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2">
        <!-- stat cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
          <StatCard value="288" label="Membres" />
          <StatCard value="14 500 €" label="Cotisations du mois" />
          <StatCard value="3" label="Projets actifs" />
        </div>

        <!-- chart area -->
        <h2 class="text-xl font-semibold mb-3">Évolution des cotisations</h2>
        <CotisationsChart />
      </div>

      <aside class="space-y-4">
        <h3 class="text-lg font-semibold">Raccourcis rapides</h3>
        <QuickAction label="Ajouter membre">
          <template #icon>👤</template>
        </QuickAction>
        <QuickAction label="Créer réunion">
          <template #icon>🗓️</template>
        </QuickAction>
        <QuickAction label="Nouveau projet">
          <template #icon>📁</template>
        </QuickAction>
      </aside>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import StatCard from '@/Components/StatCard.vue'
import CotisationsChart from '@/Components/CotisationsChart.vue'
import QuickAction from '@/Components/QuickAction.vue'

export default {
  components: { AuthenticatedLayout, StatCard, CotisationsChart, QuickAction }
}
</script>

<style scoped>
/* small tweaks if needed */
</style>

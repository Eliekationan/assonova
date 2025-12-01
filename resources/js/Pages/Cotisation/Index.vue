<template>
    <AuthenticatedLayout :path_name="'Historique des cotisations'">

        <div class="bg-white rounded-xl shadow p-4 sm:p-6">

            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full border divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Membre</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Montant dû</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Montant payé</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Période</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Statut</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        <tr
                            v-for="(item, index) in cotisations"
                            :key="index"
                            class="hover:bg-gray-50 transition"
                        >
                            <td class="px-4 py-2 text-sm text-gray-800">{{ item.membre }}</td>
                            <td class="px-4 py-2 text-sm font-medium text-gray-900 font-mono">{{ formatMoney(item.montant_du) }}</td>
                            <td class="px-4 py-2 text-sm font-medium text-gray-700 font-mono">{{ formatMoney(item.montant_paye) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ item.mois }}</td>

                            <td class="px-4 py-2">
                                <span :class="statusClass(item.statut)">
                                    {{ item.statut }}
                                </span>
                            </td>

                            <td class="px-4 py-2 text-sm text-blue-600 hover:underline cursor-pointer">
                                Voir
                            </td>
                        </tr>

                        <tr v-if="cotisations.length === 0">
                            <td colspan="6" class="py-6 text-center text-gray-500 text-sm">
                                Aucune cotisation trouvée
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card List -->
            <div class="md:hidden space-y-4">
                <div
                    v-for="item in cotisations"
                    :key="item.id"
                    class="border rounded-lg p-4 shadow-sm bg-white"
                >
                    <div class="flex justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">{{ item.membre }}</p>
                            <p class="text-xs text-gray-500">{{ item.mois }}</p>
                        </div>

                        <span :class="statusClass(item.statut)">
                            {{ item.statut }}
                        </span>
                    </div>

                    <div class="mt-3 text-sm">
                        <p><span class="font-medium">Montant dû :</span> {{ formatMoney(item.montant_du) }}</p>
                        <p><span class="font-medium">Montant payé :</span> {{ formatMoney(item.montant_paye) }}</p>
                    </div>

                    <button class="mt-3 text-blue-600 hover:underline text-sm">
                        Voir détails
                    </button>
                </div>

                <p v-if="cotisations.length === 0" class="text-center text-gray-500 text-sm">
                    Aucune cotisation trouvée
                </p>
            </div>

        </div>
        <template #mobile-actions>
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-lg p-3
                    flex justify-around">

          <!-- Ajouter -->
          <button
            @click="createRule"
            class="flex flex-col items-center text-indigo-600"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-xs mt-1">Ajouter</span>
          </button>

          <!-- Exporter -->
          <button
            @click="exportRules"
            class="flex flex-col items-center text-gray-700"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
            </svg>
            <span class="text-xs mt-1">Exporter</span>
          </button>

        </div>
      </template>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

const cotisations = ref([
  {
    id: 1,
    membre: "Koffi Marcel",
    mois: "Jan 2025",
    montant_du: 5000,
    montant_paye: 5000,
    statut: "payé",
  },
  {
    id: 2,
    membre: "Aya Nadia",
    mois: "Jan 2025",
    montant_du: 5000,
    montant_paye: 0,
    statut: "en retard",
  },
  {
    id: 3,
    membre: "Yao Jean",
    mois: "Jan 2025",
    montant_du: 5000,
    montant_paye: 2000,
    statut: "partiel",
  },
]);

const formatMoney = (value) =>
  new Intl.NumberFormat("fr-FR", {
    style: "currency",
    currency: "XOF",
  }).format(value);

const statusClass = (status) => {
  switch (status) {
    case "payé":
      return "px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600";
    case "en retard":
      return "px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600";
    case "partiel":
      return "px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600";
    default:
      return "px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600";
  }
};
</script>

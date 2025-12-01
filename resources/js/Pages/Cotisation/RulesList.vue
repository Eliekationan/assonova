<template>
  <AuthenticatedLayout :path_name="'Liste des règles de cotisation'">
    <div class="p-6 max-w-5xl mx-auto pb-24 md:pb-6">
      <div class="hidden md:flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Règles de cotisation</h1>

        <div class="flex gap-3">
          <button
            @click="createRule"
            class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg"
          >
            Ajouter
          </button>

          <button
            @click="exportRules"
            class="bg-gray-700 hover:bg-gray-800 text-white py-2 px-4 rounded-lg"
          >
            Exporter
          </button>
        </div>
      </div>

      <!-- Titre mobile -->
      <h1 class="text-xl font-bold text-gray-800 mb-4 md:hidden">
        Règles de cotisation
      </h1>

      <!-- TABLE DESKTOP -->
      <div class="hidden md:block bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full table-auto border-collapse">
          <thead class="bg-gray-50 text-left text-gray-600 text-sm">
            <tr>
              <th class="px-6 py-3">Nom</th>
              <th class="px-6 py-3">Montant</th>
              <th class="px-6 py-3">Fréquence</th>
              <th class="px-6 py-3">Type</th>
              <th class="px-6 py-3">Statut</th>
              <th class="px-6 py-3 text-center">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="item in rules"
              :key="item.id"
              class="border-b hover:bg-gray-50"
            >
              <td class="px-6 py-4 font-medium text-gray-800">
                {{ item.name }}
              </td>
              <td class="px-6 py-4 text-gray-700">
                {{ formatMoney(item.amount) }}
              </td>
              <td class="px-6 py-4 capitalize text-gray-700">
                {{ item.frequency }}
              </td>
              <td class="px-6 py-4 capitalize text-gray-700">
                {{ item.type }}
              </td>

              <td class="px-6 py-4">
                <span
                  class="px-3 py-1 text-xs rounded-full"
                  :class="
                    item.active
                      ? 'bg-green-100 text-green-600'
                      : 'bg-red-100 text-red-600'
                  "
                >
                  {{ item.active ? 'Actif' : 'Inactif' }}
                </span>
              </td>

              <td class="px-6 py-4 text-center">
                <button class="text-indigo-600 hover:underline">
                  Voir détails
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- MOBILE LIST -->
      <div class="md:hidden space-y-4">
        <div
          v-for="item in rules"
          :key="item.id"
          class="border rounded-lg p-4 shadow-sm bg-white"
        >
          <div class="flex justify-between mb-2">
            <div>
              <p class="font-semibold text-gray-800">{{ item.name }}</p>
              <p class="text-xs text-gray-500">
                {{ formatMoney(item.amount) }}
              </p>
            </div>

            <span
              class="px-2 py-1 text-xs rounded-full"
              :class="
                item.active
                  ? 'bg-green-100 text-green-600'
                  : 'bg-red-100 text-red-600'
              "
            >
              {{ item.active ? 'Actif' : 'Inactif' }}
            </span>
          </div>

          <p class="text-sm text-gray-600 capitalize">
            {{ item.frequency }} • Type : {{ item.type }}
          </p>

          <div class="flex justify-end pt-3">
            <button class="text-indigo-600 hover:underline text-sm">
              Voir détails
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- MOBILE TAB BAR -->
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

const rules = [
  {
    id: 1,
    name: "Cotisation mensuelle",
    amount: 5000,
    frequency: "mensuelle",
    type: "fixe",
    active: true,
  },
  {
    id: 2,
    name: "Cotisation annuelle",
    amount: 60000,
    frequency: "annuelle",
    type: "variable",
    active: false,
    },
  {
    id: 3,
    name: "Cotisation annuelle",
    amount: 60000,
    frequency: "annuelle",
    type: "variable",
    active: false,
    },
  {
    id: 4,
    name: "Cotisation mensuelle",
    amount: 5000,
    frequency: "mensuelle",
    type: "fixe",
    active: true,
  },
];

const createRule = () => {
  console.log("Créer une règle");
};

const exportRules = () => {
  console.log("Exporter les règles");
};

const formatMoney = (value) =>
  new Intl.NumberFormat("fr-FR", {
    style: "currency",
    currency: "XOF",
    minimumFractionDigits: 0,
  }).format(value);
</script>

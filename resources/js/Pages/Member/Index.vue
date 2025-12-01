<template>
    <AuthenticatedLayout path_name="Liste des membres">
          <Table :columns="columns" :data="membres" />
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import Table from '@/Components/Table.vue';
import ActifBadge from '@/Components/ActifBadge.vue'
import ActionButtons from '@/Components/ActionButton.vue'

const membres = ref([
  { id: 1, nom: 'Coulibaly Kactionan', email: 'kactionan@example.com', actif: true },
  { id: 2, nom: 'Elie Doe', email: 'elie@example.com', actif: false },
  { id: 3, nom: 'Marie Dupont', email: 'marie@example.com', actif: true },
]);
const columns = [
  { key: 'id', label: '#' },
  { key: 'nom', label: 'Nom' },
  { key: 'email', label: 'Email' },
  {
    key: 'actif',
    label: 'Statut',
    render: ActifBadge
  },
  {
    key: 'actions',
    label: 'Actions',
    render: ActionButtons
  }
];
</script>

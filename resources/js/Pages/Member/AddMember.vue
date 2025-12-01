<template>
    <AuthenticatedLayout :path_name="'Ajouter un membre'">
        <FormCard @submit="submit">
            <template #title>
            <!-- Formulaire d'ajout -->
            </template>

            <!-- Les champs -->
            <div class="">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Nom complet
                </label>
                <input
                v-model="form.name"
                type="text"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Email
                </label>
                <input
                v-model="form.email"
                type="email"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Téléphone
                </label>
                <input
                v-model="form.telephone"
                type="text"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Adresse
                </label>
                <input
                v-model="form.adresse"
                type="text"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Role
                </label>
                <select v-model="form.role" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="Membre">Membre</option>
                    <option value="Président">Président</option>
                    <option value="Secretaire">Secretaire</option>
                    <option value="Tresorier">Tresorier</option>
                </select>

            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Section
                </label>
                <select v-model="form.section" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="Section Abidjan">Section Abidjan</option>
                    <option value="Section Bouake">Section Bouake</option>
                    <option value="Section Katiola">Section Katiola</option>
                    <option value="Section Petionara">Section Petionara</option>
                </select>

            </div>

            </div>

            <!-- Boutons -->
            <template #actions>
            <div class="flex justify-end gap-3">
                <button
                type="button"
                class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300"
                >
                Annuler
                </button>

                <button
                type="submit"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                >
                Enregistrer
                </button>
            </div>
            </template>
        </FormCard>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormCard from '@/Components/FormCard.vue';

import { ref } from 'vue'

const form = ref({
  name: '',
  email: '',
  telephone: '',
})
</script>

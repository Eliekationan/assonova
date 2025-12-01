<template>
    <AuthenticatedLayout :path_name="'Créer une règle de cotisation'">

        <div class="max-w-3xl mx-auto p-4 sm:p-6">

            <!-- Title -->
            <!-- <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Nouvelle règle de cotisation
                </h1>
                <p class="text-gray-500 mt-1">
                    Définissez comment les membres doivent cotiser (montant, fréquence, etc.)
                </p>
            </div> -->

            <!-- Card -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 sm:p-8 space-y-8">

                <!-- Section 1 : Informations générales -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Informations générales</h2>

                    <div class="space-y-6">
                        <!-- Nom -->
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nom de la règle</label>
                            <input v-model="form.name"
                                type="text"
                                class="mt-1 w-full border border-gray-300 rounded-xl py-2.5 px-3 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                                placeholder="Ex : Cotisation mensuelle standard" />
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="text-sm font-medium text-gray-600">Description</label>
                            <textarea v-model="form.description"
                                rows="3"
                                class="mt-1 w-full border border-gray-300 rounded-xl py-2.5 px-3 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                                placeholder="Explication détaillée de la règle (optionnel)">
                            </textarea>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Appliquer à</label>

                            <Multiselect
                            v-model="form.categorie"
                            :options="options"
                            :multiple="true"
                            placeholder="Sélectionnez une ou plusieurs catégories"
                            label="label"
                            track-by="value"
                            class="mt-1 border border-gray-300 rounded-xl shadow-sm focus-within:ring-2 focus-within:ring-indigo-200 focus-within:border-indigo-500 w-full"
                            />
                        </div>
                    </div>
                </div>

                <!-- Section 2 : Paramètres financiers -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Paramètres financiers</h2>

                    <div class="grid sm:grid-cols-2 gap-6">

                        <!-- Montant -->
                        <div>
                            <label class="text-sm font-medium text-gray-600">Montant</label>
                            <input v-model.number="form.amount"
                                type="number"
                                class="mt-1 w-full border border-gray-300 rounded-xl py-2.5 px-3 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                                placeholder="Ex : 5000" />
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="text-sm font-medium text-gray-600">Type</label>
                            <select v-model="form.type"
                                class="mt-1 w-full border border-gray-300 rounded-xl py-2.5 px-3 bg-white shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
                                <option value="fixed">Fixe</option>
                                <option value="variable">Variable</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Section 3 : Conditions -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Conditions</h2>

                    <div class="grid sm:grid-cols-2 gap-6">

                        <!-- Fréquence -->
                        <div>
                            <label class="text-sm font-medium text-gray-600">Fréquence</label>
                            <select v-model="form.frequency"
                                class="mt-1 w-full border border-gray-300 rounded-xl py-2.5 px-3 bg-white shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
                                <option value="monthly">Mensuelle</option>
                                <option value="quarterly">Trimestrielle</option>
                                <option value="yearly">Annuelle</option>
                            </select>
                        </div>

                        <!-- Date début -->
                        <div>
                            <label class="text-sm font-medium text-gray-600">Date de début</label>
                            <input v-model="form.start_date"
                                type="date"
                                class="mt-1 w-full border border-gray-300 rounded-xl py-2.5 px-3 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500" />
                        </div>

                    </div>

                    <!-- Statut -->
                    <div class="flex items-center gap-3 mt-4">
                        <input v-model="form.active"
                            id="active"
                            type="checkbox"
                            class="h-5 w-5 text-indigo-600 rounded" />
                        <label for="active" class="text-sm font-medium text-gray-700">
                            Activer cette règle
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button @click="submit"
                        class="w-full bg-indigo-200 hover:bg-indigo-700 text-gray-900 py-3 rounded-xl font-semibold shadow-md transition">
                        Enregistrer la règle
                    </button>
                </div>

            </div>

        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';
import { ref } from "vue";

const form = ref({
  name: "",
  amount: null,
  frequency: "monthly",
  type: "fixed",
  start_date: "",
  active: true,
  description: "",
  categorie: [],
});
const options = ref([
  { label: "Membre simple", value: "membre_simple" },
  { label: "Bureau executif", value: "bureau_executif" },
  { label: "Tous les membres", value: "tous_les_membres" },
]);

const submit = () => {
  router.post("/cotisation-rules", form);
};
</script>

<style scoped>
</style>

<template>
  <AuthenticatedLayout :path_name="'Payer / Faire un don'">
    <div class="max-w-2xl mx-auto p-4 sm:p-6">
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <!-- <h1 class="text-2xl font-semibold text-gray-800 mb-3">Effectuer un paiement / don</h1> -->
        <p class="text-sm text-gray-500 mb-6">
          Choisissez le type, le montant et le mode de paiement. Vous serez redirigé vers la
          passerelle pour confirmer la transaction.
        </p>

        <form @submit.prevent="startPayment" class="space-y-4">
          <!-- Type -->
          <div>
            <label class="text-sm font-medium text-gray-700">Type de paiement</label>
            <div class="mt-2 grid grid-cols-3 gap-2">
              <button
                type="button"
                :class="type === 'cotisation' ? activeBtnClass : inactiveBtnClass"
                @click="type = 'cotisation'"
              >
                Cotisation
              </button>
              <button
                type="button"
                :class="type === 'don' ? activeBtnClass : inactiveBtnClass"
                @click="type = 'don'"
              >
                Don
              </button>
              <button
                type="button"
                :class="type === 'special' ? activeBtnClass : inactiveBtnClass"
                @click="type = 'special'"
              >
                Spéciale
              </button>
            </div>
          </div>
          <!-- Si cotisation → Choisir la règle -->
        <div v-if="type === 'cotisation'">
            <label class="text-sm font-medium text-gray-700">Sélectionnez une règle</label>
            <select v-model="rule_id"
                    class="mt-2 w-full border border-gray-300 rounded-xl px-3 py-2">
                <option disabled value="">-- Choisir une règle --</option>
                <option  value="Cotisantion exceptionnelle">Cotisantion exceptionnelle</option>
                <option  value="Cotisation mensuelle">Cotisation mensuelle</option>
                <option v-for="rule in rules" :key="rule.id" :value="rule.id">
                {{ rule.libelle }} — {{ rule.montant }} FCFA
                </option>
            </select>
        </div>
          <!-- Montant -->
          <div>
            <label class="text-sm font-medium text-gray-700">Montant (FCFA)</label>
            <input
              v-model.number="amount"
              type="number"
              min="0"
              placeholder="Ex : 5000"
              class="mt-2 w-full border border-gray-300 rounded-xl px-3 py-2 focus:ring-2 focus:ring-indigo-200"
              required
            />
            <p v-if="amountError" class="text-xs text-red-600 mt-1">{{ amountError }}</p>
          </div>

          <!-- Mode de paiement -->
        <div>
            <label class="text-sm font-medium text-gray-700">Mode de paiement</label>

            <div class="mt-3 grid grid-cols-3 gap-4">
                <div
                v-for="method in paymentMethods"
                :key="method.value"
                @click="methodSelected = method.value"
                class="cursor-pointer flex flex-col items-center p-4 rounded-xl border transition
                        hover:bg-gray-50"
                :class="methodSelected === method.value ? 'border-indigo-600 bg-indigo-50' : 'border-gray-300'"
                >
                <img
                    v-if="method.icon"
                    :src="method.icon"
                    class="w-12 h-12 object-contain"
                    alt="Logo"
                />

                <span class="text-sm font-medium text-gray-700 mt-2 text-center">
                    {{ method.label }}
                </span>

                <!-- Radio caché mais connecté -->
                <input
                    type="radio"
                    class="hidden"
                    v-model="methodSelected"
                    :value="method.value"
                />
                </div>
            </div>
        </div>


          <!-- Reference / Note (optionnel) -->
          <div>
            <label class="text-sm font-medium text-gray-700">Référence / Note (optionnel)</label>
            <input
              v-model="note"
              type="text"
              placeholder="Ex : Contribution pour projet X"
              class="mt-2 w-full border border-gray-300 rounded-xl px-3 py-2 focus:ring-2 focus:ring-indigo-200"
            />
          </div>

          <!-- Actions -->
          <div class="flex items-center justify-between gap-3 pt-3">
            <button
              type="button"
              @click="cancel"
              class="px-4 py-2 rounded-xl border text-gray-700"
              :disabled="loading"
            >
              Annuler
            </button>

            <button
              type="submit"
              class="px-4 py-2 rounded-xl bg-indigo-600 text-white flex items-center gap-3"
              :disabled="loading"
            >
              <svg v-if="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c-3.866 0-7 1.79-7 4v4h14v-4c0-2.21-3.134-4-7-4zM12 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg>
              <svg v-else class="w-5 h-5 animate-spin" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" />
              </svg>
              <span>{{ loading ? 'Traitement...' : (type === 'don' ? 'Faire un don' : 'Payer') }}</span>
            </button>
          </div>
        </form>

        <!-- Feedback -->
        <div v-if="statusMessage" :class="statusClassMsg" class="mt-4 p-3 rounded-md text-sm">
          {{ statusMessage }}
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';

const type = ref('cotisation');
const amount = ref(null);
const note = ref('');
const methodSelected = ref('mobile_money');
const loading = ref(false);
const statusMessage = ref('');
const statusType = ref(''); // success | error | info

const paymentMethods = [
  {
    value: 'orange_money',
    label: 'Orange money',
    icon: '/assets/orange.png',
  },
  {
    value: 'mtn_money',
    label: 'MTN money',
    icon: '/assets/mtn.jpeg',
  },
  {
    value: 'wave_money',
    label: 'Wave',
    icon: '/assets/wave.png',
  },
];

const activeBtnClass = 'px-3 py-2 rounded-xl bg-indigo-600 text-white';
const inactiveBtnClass = 'px-3 py-2 rounded-xl bg-gray-100 text-gray-700';

const amountError = ref('');

const statusClassMsg = computed(() => {
  return statusType.value === 'success'
    ? 'bg-green-50 text-green-800 border border-green-100'
    : statusType.value === 'error'
    ? 'bg-red-50 text-red-800 border border-red-100'
    : 'bg-yellow-50 text-yellow-800 border border-yellow-100';
});

const validate = () => {
  amountError.value = '';
  if (!amount.value || amount.value <= 0) {
    amountError.value = 'Veuillez saisir un montant valide.';
    return false;
  }
  return true;
};

const startPayment = async () => {
  if (!validate()) return;
  loading.value = true;
  statusMessage.value = 'Préparation du paiement...';
  statusType.value = 'info';

  try {
    // Appel backend pour initier le paiement (Laravel controller)
    // Le backend doit retourner { payment_id, redirect_url } (ou token) selon passerelle
    const payload = {
      type: type.value,
      amount: amount.value,
      method: methodSelected.value,
      note: note.value,
    };

    const res = await axios.post('/payments/initiate', payload);
    // Exemple de réponse attendue :
    // { success: true, data: { payment_id: 'abc123', redirect_url: 'https://payeasy/...' } }

    if (res.data && res.data.data) {
      const { payment_id, redirect_url } = res.data.data;

      // Sauvegarde locale temporaire si besoin (sessionStorage)
      sessionStorage.setItem('pending_payment_id', payment_id);

      // Rediriger vers la passerelle de paiement (si fournie)
      if (redirect_url) {
        window.location.href = redirect_url;
        return;
      }

      // Si la passerelle est intégrée (ex: paiement par API côté serveur),
      // le backend peut renvoyer un objet permettant d'ouvrir un widget ou modal.
      // Ici on attend plutôt un redirect.
      statusMessage.value = 'Redirection vers la passerelle...';
    } else {
      throw new Error(res.data.message || 'Erreur lors de l\'initialisation du paiement');
    }
  } catch (err) {
    console.error(err);
    statusType.value = 'error';
    statusMessage.value = err.response?.data?.message || err.message || 'Erreur de paiement';
    loading.value = false;
  }
};

const cancel = () => {
  // action d'annulation : reset du formulaire ou navigation
  amount.value = null;
  note.value = '';
  statusMessage.value = '';
  statusType.value = '';
};

</script>

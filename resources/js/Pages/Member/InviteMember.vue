<template>
    <AuthenticatedLayout :path_name="'Inviter un membre'">
        <FormCard  @submit="sendInvitation">
            <template #title>
                <div class="flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>

                    <h6 class="text-sm text-green-500">Vous avez la possibilité de renseigner l'email ou le numero WhatsApp</h6>
                </div>
            </template>

            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email du membre
                    </label>
                    <input
                    v-model="invite.email"
                    type="email"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                    Téléphone du membre
                    </label>
                    <input
                    v-model="invite.telephone"
                    type="email"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2"
                    />
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Contenu du message
                </label>
                <QuillEditor theme="snow" />
            </div>

            <template #actions>
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Envoyer l'invitation
                    </button>
                </div>
            </template>
            </FormCard>

    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormCard from '@/Components/FormCard.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref } from 'vue'

const invite = ref({
  email: '',
  telephone: '',
})
</script>

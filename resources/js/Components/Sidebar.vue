<template>
  <!-- Overlay pour mobile -->
  <div
    v-if="isOpen"
    class="fixed inset-0 bg-black/40 md:hidden z-40"
    @click="$emit('toggle-sidebar')"
  ></div>

  <!-- Sidebar -->
  <aside
    :class="[
      'bg-[#1C6279] text-white p-6 flex flex-col justify-between h-full overflow-y-auto',
      'fixed top-0 left-0 w-84 z-50 transition-transform duration-300',
      isOpen ? 'translate-x-0' : '-translate-x-full',
      'md:translate-x-0 md:static md:h-auto md:rounded-l-xl'
    ]"
  >
     <!-- Bouton fermer mobile -->
  <button
    @click="$emit('toggle-sidebar')"
    class="absolute top-4 right-4 p-2 rounded-md bg-[#154C5C] text-white sm:hidden"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12"/>
    </svg>
  </button>
    <!-- Logo -->
    <div>
      <div class="flex items-center gap-3 mb-8">
        <Link :href="route('dashboard')">
          <ApplicationLogo class="block h-9 w-auto fill-white" />
        </Link>
        <div class="font-semibold text-lg text-[#eab308]">Assonova</div>
      </div>

      <!-- Menu -->
      <nav class="space-y-2">
        <!-- Dashboard simple -->
        <Link
          :href="route('dashboard')"
          class="block px-4 py-2 rounded-md bg-[#154C5C] hover:bg-[#0f4a5d]"
        >
          Dashboard
        </Link>

        <!-- Gestion des membres -->
        <DropdownMenu label="Gestion des membres" icon="users">
          <DropdownItem :href="route('member.index')" :autoClose="() => isOpen=false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            Liste des membres
          </DropdownItem>
          <DropdownItem :href="route('member.insert')" :autoClose="() => isOpen=false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
            </svg>

            Ajouter un membre
          </DropdownItem>
          <DropdownItem :href="route('member.invite')" :autoClose="() => isOpen=false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
            </svg>
            Inviter un membre
          </DropdownItem>
        </DropdownMenu>

        <!-- Gestion des cotisations -->
        <DropdownMenu label="Gestion des cotisations" icon="folder">

            <DropdownItem :href="route('payments.initiate')" :autoClose="() => isOpen=false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
            </svg>
            Payer une cotisation
          </DropdownItem>
          <DropdownItem :href="route('cotisation.index')" :autoClose="() => isOpen=false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
            </svg>
            Historique des cotisations
          </DropdownItem>

          <DropdownItem :href="route('cotisation.ruleList')" :autoClose="() => isOpen=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4">
                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
                </svg>
                Collecter
            </DropdownItem>
          <DropdownItem :href="route('cotisation.ruleList')" :autoClose="() => isOpen=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4">
                <path fill-rule="evenodd" d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>

                Liste des règles
            </DropdownItem>
          <DropdownItem :href="route('cotisation.newRule')" :autoClose="() => isOpen=false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
            </svg>
            Ajouter une règle
          </DropdownItem>
        </DropdownMenu>

        <!-- Projets & activités -->
        <DropdownMenu label="Projets & activités" icon="folder">
          <!-- <DropdownItem :href="route('projects.index')" :autoClose="() => isOpen=false">
            Liste des projets
          </DropdownItem>
          <DropdownItem :href="route('projects.budgets')" :autoClose="() => isOpen=false">
            Budgets
          </DropdownItem> -->
        </DropdownMenu>

        <!-- Rapports simple -->
        <Link href="#" class="block px-4 py-2 rounded-md hover:bg-[#154C5C]">
          Rapports & statistiques
        </Link>
      </nav>
    </div>

    <!-- Profil -->
    <div class="flex items-center gap-3 px-2 mt-6 py-4 border-t border-white/20">
      <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full border-2 border-yellow-400" alt="avatar" />
      <div class="text-sm font-medium text-yellow-300">{{ authUser?.name }}</div>
    </div>
  </aside>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

// Import des dropdowns
import DropdownMenu from "./DropdownMenu.vue";
import DropdownItem from "./DropdownItem.vue";
import { usePage } from "@inertiajs/vue3";


const page = usePage();
console.log("page.props.value", page.props.auth.user)
const authUser = page.props.auth.user;
defineProps({
  isOpen: { type: Boolean, default: false }
});
</script>

<style scoped>
/* Rien à ajouter, tout est géré par Tailwind */
</style>

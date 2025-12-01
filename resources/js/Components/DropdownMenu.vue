<template>
  <div class="w-full">
    <!-- Trigger -->
    <button
      @click="toggle"
      class="w-full flex items-center justify-between px-4 py-2 text-white"
    >
      <div class="flex items-center gap-2">
        <!-- Icône si fournie -->
        <component
          v-if="icon"
          :is="getIcon(icon)"
          class="w-5 h-5 text-[#eab308]"
        />

        <span>{{ label }}</span>
      </div>

      <!-- Chevron -->
      <svg
        :class="['w-4 h-4 transition-transform', open ? 'rotate-180' : 'rotate-0']"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 9l-7 7-7-7"/>
      </svg>
    </button>

    <!-- Contenu -->
    <transition name="slide">
      <div
        v-if="open"
        class="mt-[-2] bg-white text-black overflow-hidden"
      >
        <slot></slot>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref } from "vue";
import {
  UserIcon,
  UsersIcon,
  FolderIcon,
  ChevronDownIcon,
} from "@heroicons/vue/24/outline";

const props = defineProps({
  label: { type: String, required: true },
  icon: { type: String, default: null }
});

const open = ref(false);

const toggle = () => (open.value = !open.value);

const getIcon = (name) => {
  const map = {
    user: UserIcon,
    users: UsersIcon,
    folder: FolderIcon,
    chevron: ChevronDownIcon,
  };
  return map[name] || null;
};
</script>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: all 0.2s ease;
}
.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  max-height: 0;
}
.slide-enter-to,
.slide-leave-from {
  opacity: 1;
  max-height: 500px;
}
</style>

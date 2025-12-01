<template>
  <Link
    :href="href"
    @click="handleClick"
    class="flex items-center gap-2 px-6 py-2 text-sm transition
          hover:bg-gray-100
          border-l-2"
    :class="isActive ? 'bg-gray-100 border-blue-500 font-medium' : 'border-transparent'"
  >
    <slot></slot>
  </Link>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
  href: { type: String, required: true },
  autoClose: { type: Function, default: null }
});

const page = usePage();
const currentUrl = page.url;

const isActive = computed(() => currentUrl === props.href);

const handleClick = () => {
  if (props.autoClose) props.autoClose();
};
</script>

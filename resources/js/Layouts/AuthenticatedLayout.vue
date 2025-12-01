<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar.vue';
import { Link } from '@inertiajs/vue3';

// const showingNavigationDropdown = ref(false);
const sidebarOpen = ref(false);
defineProps({
    path_name:{type: String, default: "Tableau de bord"}
})
</script>

<template>
  <div class="dashboard-container min-h-screen bg-gray-50 flex">
    <Sidebar :isOpen="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen"/>

    <div class="flex-1 p-2">
      <!-- HEADER FIXE -->
      <div class="sticky top-0 z-3 bg-white">
        <Navbar @toggle-sidebar="sidebarOpen = !sidebarOpen" :path_name="path_name"/>
      </div>

      <div>
        <slot />
      </div>
    </div>
    <div class="md:hidden">
      <slot name="mobile-actions" />
    </div>
  </div>
</template>

<style>
    .dashboard-container{
        padding: 1%;
    }
</style>

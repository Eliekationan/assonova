<!-- <script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class=" guest-layaout-bg flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="fill-current text-gray-500" style="width: 130px;" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>
.guest-layaout-bg{
    background-color: #1c6279;
}
</style> -->

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="guest-layout">
        <!-- Logo -->
        <div class="logo-container">
            <Link href="/">
                <ApplicationLogo class="logo" />
            </Link>
        </div>

        <!-- Card -->
        <div class="card">
            <slot />
        </div>
    </div>
</template>

<style scoped>
/* Background */
.guest-layout {
    background: #1c6279; /* Ta couleur principale */
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 15px;
}

/* Logo */
.logo-container {
    margin-bottom: 25px;
}

.logo {
    width: 140px;
    filter: brightness(0) invert(1); /* Logo blanc automatique */
}

/* Card container */
.card {
    width: 100%;
    max-width: 420px;
    background: white;
    padding: 35px 30px;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.08);
}
</style>

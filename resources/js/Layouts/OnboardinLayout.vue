<template>
  <div class="onboarding-container">
    <header style="text-align: center;">
      <h1>{{title}}</h1>
      <h4 style="font-size: 14px; color: #feff40;">{{ subtitle }}</h4>
    </header>

    <main>
      <slot />
    </main>
  </div>
</template>
<script setup>
    const props = defineProps({
        title: String,
        subtitle: String
    });
</script>
<style>
.onboarding-container {
  width: 100%;
  min-height: 100vh;
  /* background: #f5f6fa; */
  background: #1c6279;
  display: flex;
  flex-direction: column;
  align-items: center;
}

header {
  width: 100%;
  background: #1c6279;
  padding: 20px 40px;
  color: white;
  font-size: 22px;
  font-weight: bold;
}

main {
  width: 100%;
  max-width: 900px;
  margin-top: 40px;
  padding: 20px;
  display: flex;
  justify-content: center;
}
</style>

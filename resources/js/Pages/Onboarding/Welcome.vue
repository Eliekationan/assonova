<template>
  <div class="welcome-page">
    <div class="content">
      <!-- Logo -->
       <div class="logo-container">
           <img
             src="/assets/logo-assonova.png"
             alt="AssoNova Logo"
             class="logo"
           />
       </div>

      <!-- Title -->
      <h1 class="title">
        Bienvenue<br />
        sur Assonova
      </h1>

      <!-- Subtitle -->
      <p class="subtitle">
        La plateforme moderne pour gérer<br />
        votre association, vos membres,<br />
        vos cotisations et vos activités...<br />
        en toute simplicité.
      </p>

      <!-- Primary button -->
      <button class="btn-primary" @click="goCreate">
        Créer mon association
      </button>

      <!-- Secondary button -->
      <button class="btn-secondary" @click="goLogin">
        J’ai déjà un compte
      </button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    goCreate() {
      this.$emit("next");
    },
    goLogin() {
      this.$inertia.visit("/login");
    },
  },
};
</script>

<style scoped>
/* Background full page */
.welcome-page {
  width: 100%;
  min-height: 100vh;
  background: #1c6279; /* Bleu profond Assonova */
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}

/* Center content box */
.content {
  text-align: center;
  color: white;
  max-width: 500px;
}
.logo-container{
    display: flex;
    justify-content: center;
}

/* Logo */
.logo {
  width: 80px;
  /* margin-bottom: 30px; */
}

/* Title */
.title {
  font-size: 48px;
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 25px;
}

/* Subtitle */
.subtitle {
  font-size: 18px;
  color: #e3eaf0;
  line-height: 1.6;
  margin-bottom: 40px;
}

/* Primary button */
.btn-primary {
  width: 100%;
  padding: 16px;
  background: #0f3f51; /* Variante plus sombre pour effet */
  border: none;
  border-radius: 10px;
  font-size: 20px;
  color: white;
  cursor: pointer;
  transition: 0.2s;
}

.btn-primary:hover {
  background: #0b2f3d;
}

/* Secondary link-button */
.btn-secondary {
  margin-top: 20px;
  background: transparent;
  border: none;
  font-size: 18px;
  color: #eab308; /* Jaune Assonova */
  cursor: pointer;
  text-decoration: none;
}

.btn-secondary:hover {
  opacity: 0.8;
}
</style>

<template>
  <OnboardingLayout>
    <div class="finish-box">
      <h2>🎉 Félicitations !</h2>
      <p>Votre association a été configurée avec succès.</p>

      <button class="btn-primary" @click="goToDashboard">
        Accéder au tableau de bord
      </button>
    </div>
  </OnboardingLayout>
</template>

<script>
import OnboardingLayout from "../../Layouts/OnboardinLayout.vue";

export default {
  components: { OnboardingLayout },
  methods: {
    goToDashboard() {
      // Redirection vers ton dashboard Laravel
      window.location.href = "/dashboard";
    }
  }
};
</script>

<style>
.finish-box {
  text-align: center;
  margin-top: 60px;
}

.finish-box h2 {
  font-size: 32px;
}
.finish-box p {
  margin-top: 10px;
  color: rgb(131, 191, 131);
  margin-bottom: 40px;
}
.btn-primary{
    border: 2px solid white;
}
</style>

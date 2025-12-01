<template>
  <OnboardingLayout :title="'Informations de l\'administrateur principal'">
    <div class="form-box">
      <h2>Informations de l'administrateur principal</h2>

      <label>Nom complet</label>
      <input type="text" v-model="form.nom_dirigeant" />

      <label>Téléphone</label>
      <input type="text" v-model="form.telephone_dirigeant" />

      <!-- <label>Mot de passe</label>
      <input type="password" v-model="form.password" /> -->

      <div class="actions">
        <button class="btn-secondary" @click="$emit('prev')">Retour</button>
        <button class="btn-primary" @click="$emit('next')">Suivant</button>
      </div>
    </div>
  </OnboardingLayout>
</template>

<script>
import OnboardingLayout from "../../Layouts/OnboardinLayout.vue";

export default {
  components: { OnboardingLayout },
  props: ["form"]
};
</script>

<style>
.form-box {
  text-align: center;
  color: white;
  max-width: 500px;
}
.title {
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 25px;
  color: #feff40;
  font-size: larger;
  font-weight: bolder;
}

.stepper {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.step {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #e6e6e6;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: .3s;
  font-weight: bold;
}

.step.active {
  background: #1c6279;
  color: white;
}

.question-text {
  font-size: 30px;
  font-weight: 600;
  margin-bottom: 15px;
  min-height: 40px;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s ease;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
p{
    padding: 25px;
}

input,
select {
  width: 100%;
  padding: 14px;
  margin-top: 10px;
  border-radius: 6px;
  border: 1px solid #cccccc;
  font-size: 16px;
  color: black;
}

.actions {
  display: flex;
  justify-content: center;
  margin-top: 25px;
}

.btn-primary {
  background: #1c6279;
  color: white;
  padding: 10px 22px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-size: large;
}
.btn-primary:hover {
  background: #174f62;
}

.btn-secondary {
  background: #cccccc;
  padding: 10px 22px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-size: large;
}
.btn-secondary:hover {
  background: #b7b7b7;
}

.confirmation-box {
  /* background: #f8f8f8; */
  padding: 15px;
  border-radius: 6px;
  text-align: start;
}
.onboarding-page {
  width: 100%;
  /* min-height: 100vh; */
  background: #1c6279; /* Bleu profond Assonova */
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}
/* Même CSS que AssociationInfo (donc tu peux mutualiser si tu veux) */
</style>

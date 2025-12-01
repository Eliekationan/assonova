<template>
    <OnboardingLayout
    :title="'Informations sur l\'association'"
    :subtitle="'Pouvons-nous en savoir plus sur votre association'"
    >
        <div class="form-box">


          <!-- STEP INDICATOR -->
          <!-- <div class="stepper">
            <div
              v-for="(s, idx) in steps"
              :key="idx"
              class="step"
              :class="{ active: idx === currentStep }"
            >
              {{ idx + 1 }}
            </div>
          </div> -->

          <!-- QUESTION ANIMÉE -->
          <transition name="fade">
            <p v-if="displayedText" class="question-text">
              {{ displayedText }}
            </p>
          </transition>

          <!-- INPUTS PAR ETAPE -->
          <div class="input-wrapper">

            <!-- Step 1 -->
            <template v-if="currentStep === 0">
              <input
                type="text"
                v-model="form.nom"
                @keyup.enter="nextStep"
                placeholder="Ex : Association Jeunesse Active"
              />
            </template>

            <!-- Step 2 -->
            <template v-if="currentStep === 1">
              <select v-model="form.type" @change="nextStep">
                <option disabled value="">Sélectionnez...</option>
                <option value="humanitaire">Humanitaire</option>
                <option value="sportive">Sportive</option>
                <option value="religieuse">Religieuse</option>
                <option value="autre">Autre</option>
              </select>
            </template>

            <!-- Step 3 -->
            <template v-if="currentStep === 2">
              <input
                type="text"
                v-model="form.adresse"
                @keyup.enter="nextStep"
                placeholder="Ex : Abidjan, Yopougon..."
              />
            </template>

            <!-- Step 4 : Récap -->
            <template v-if="currentStep === 3">
              <div class="confirmation-box">
                <p>
                    Vous avez dit que le nom de votre association est : <strong>
                        <b>{{ form.nom }}</b>
                    </strong>
                </p>
                <p>
                    Vous avez selectionné <strong><b>{{ form.type }}</b> </strong>
                    comme type d'association
                 </p>
                <p>
                    L'adresse de votre association est :
                    <strong><b>{{ form.adresse }}</b></strong>
                </p>
              </div>
            </template>
          </div>

          <!-- BUTTONS -->
          <div class="actions">
            <button v-if="currentStep > 0"
                    class="btn-secondary"
                    @click="prevStep">
              Retour
            </button>

            <button v-if="currentStep < steps.length - 1"
                    class="btn-primary"
                    @click="nextStep">
              Suivant
            </button>

            <button v-if="currentStep === steps.length - 1"
                    class="btn-primary"
                    @click="$emit('next')">
              Etape Suivante
            </button>
          </div>

        </div>
      <!-- <div class="onboarding-page">
      </div> -->
    </OnboardingLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import OnboardingLayout from "../../Layouts/OnboardinLayout.vue";

const props = defineProps({
  form: Object,
});

const emit = defineEmits(["next", "prev"]);

// STEP SYSTEM
const currentStep = ref(0);

const steps = [
  "Quel est le nom de votre association ?",
  "Quel est le type de votre association ?",
  "Où est située votre association ?",
//   "Récapitulatif",
];

// === EFFET D'ÉCRITURE ======================
const displayedText = ref("");
let typingIndex = 0;
let typingInterval = null;

function startTyping() {
  displayedText.value = "";
  typingIndex = 0;

  clearInterval(typingInterval);

  const text = steps[currentStep.value];

  typingInterval = setInterval(() => {
    if (typingIndex < text.length) {
      displayedText.value += text.charAt(typingIndex);
      typingIndex++;
    } else {
      clearInterval(typingInterval);
    }
  }, 35);
}

onMounted(() => startTyping());

// === NAVIGATION ============================
function nextStep() {
  if (currentStep.value < steps.length - 1) {
    currentStep.value++;
    startTyping();
  }
}

function prevStep() {
  if (currentStep.value > 0) {
    currentStep.value--;
    startTyping();
  }
}
</script>

<style scoped>
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
</style>

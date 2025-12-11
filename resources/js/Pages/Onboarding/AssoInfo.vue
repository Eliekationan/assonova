<template>
  <OnboardingLayout
    :title="'Informations sur l\'association'"
    :subtitle="'Pouvons-nous en savoir plus sur votre association'"
  >
    <div class="form-box">

      <transition name="fade">
        <p v-if="displayedText" class="question-text">
          {{ displayedText }}
        </p>
      </transition>

      <div class="input-wrapper">
        <!-- Step 1 -->
        <template v-if="currentStep === 0">
          <input
          required
            type="text"
            v-model="form.name"
            @keyup.enter="nextStep"
            placeholder="Ex : Association Jeunesse Active"
          />
          <p v-if="errors.name" class="error">{{ errors.name }}</p>
        </template>

        <!-- Step 2 -->
         <template v-if="currentStep === 1">
            <input
            required
            type="text"
            v-model="form.acronym"
            @keyup.enter="nextStep"
            placeholder="AJUPE"
          />
          <p v-if="errors.acronym" class="error">{{ errors.acronym }}</p>
          <p v-if="errors.acronym" class="error">{{ errors.acronym }}</p>
        </template>

        <template v-if="currentStep === 2">
            <input
            required
            type="text"
            v-model="form.object"
            @keyup.enter="nextStep"
            placeholder="Unir pour la Jeunesse"
          />
          <p v-if="errors.object" class="error">{{ errors.object }}</p>
          <p v-if="errors.object" class="error">{{ errors.object }}</p>
        </template>

        <template v-if="currentStep === 3">
            <input
            required
            type="text"
            v-model="form.description"
            @keyup.enter="nextStep"
            placeholder=""
          />
          <p v-if="errors.description" class="error">{{ errors.description }}</p>
          <p v-if="errors.description" class="error">{{ errors.description }}</p>
        </template>

        <!-- Step 3 -->
        <template v-if="currentStep === 4">
          <input
            type="email"
            v-model="form.email"
            @keyup.enter="nextStep"
            placeholder="info@association.com"
          />
          <p v-if="errors.email" class="error">{{ errors.email }}</p>
        </template>

        <!-- Step 3 -->
        <template v-if="currentStep === 5">
          <input
            type="text"
            v-model="form.phone"
            @keyup.enter="nextStep"
            placeholder="Ex : +225 01 02 03 04"
          />
          <p v-if="errors.phone" class="error">{{ errors.phone }}</p>
        </template>

        <template v-if="currentStep === 6">
          <input
            type="text"
            v-model="form.siege"
            @keyup.enter="nextStep"
            placeholder="Abidjan"
          />
          <p v-if="errors.siege" class="error">{{ errors.siege }}</p>
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
                :disabled="processing"
                @click="$emit('next')">
          <span v-if="processing">Envoi...</span>
          <span v-else>Etape Suivante</span>
        </button>
      </div>

    </div>
  </OnboardingLayout>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import OnboardingLayout from "../../Layouts/OnboardinLayout.vue";

const props = defineProps({
  form: Object,
  errors: Object,
  processing: Boolean
});

const emit = defineEmits(["next", "prev", "field-changed"]);

const currentStep = ref(0);

const steps = [
  "Quel est le nom de votre association ?",
  "Quel est L'acronyme de votre association ?",
  "Quel est l'objet ou mission de votre association ?",
  "Comment decrivez-vous votre association ?",
  "Quel est l'email de votre association ?",
  "Quel est le téléphone de votre association ?",
  "Où se situe le siège de votre association ?",
];

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

watch(currentStep, () => startTyping());

// Navigation
function nextStep() {
    if (!isStepValid()) return;
    if (currentStep.value < steps.length - 1) {
        currentStep.value++;
    }
}

const isStepValid = () => {
    switch(currentStep.value) {
      case 0: // AssociationInfo
        if (!props.form.name) {
          alert("Le nom de l'association est requis !");
          return false;
        }
        return true;

        case 3:
            if (!props.form.description) {
                alert("La description de votre association est requise !");
                return false;
            }


        return true;
        case 4:
            if (!props.form.email) {
                alert("L'email de votre association est requis!");
                return false;
            }
            return true
        case 4:
            if (!props.form.email) {
                alert("Le contact téléphonique de votre association est requis!");
                return false;
            }
            return true
      default:
        return true;
    }
  }
function prevStep() {
  if (currentStep.value > 0) {
    currentStep.value--;
  }
}

// Émet l’event pour auto-save
function onFieldChanged(field) {
  emit("field-changed", field);
}
</script>

<style scoped>
.error { color: #ffb3b3; margin-top: 6px; font-size: 14px; }
</style>

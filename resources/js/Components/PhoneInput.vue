<template>
  <div
    class="flex w-full overflow-hidden focus-within:ring-blue-500 focus-within:border-blue-500"
  >
    <!-- Select du pays : largeur fixe -->
    <select style="border: 0; border-radius: 0;"
      v-model="selectedCountry"
      @change="resetNumber"
      class="w-20 h-12 px-2 bg-gray-100 text-gray-800 outline-none border-r border-gray-300 disabled:bg-gray-200 disabled:text-gray-400 text-sm"
      :disabled="disabled"
    >
      <option v-for="c in countries" :key="c.code" :value="c.code">
        {{ c.code }}
      </option>
    </select>

    <!-- Input du numéro -->
    <input
      type="text"
      v-model="formattedNumber"
      :placeholder="generatedMask"
      @input="onInput"
      @keypress="onKeyPress"
      @keydown="onKeyDown"
      @paste.prevent="onPaste"
      :disabled="disabled"
      :class="[
        'flex-1 h-12 px-4 outline-none text-gray-900 placeholder-gray-400 text-sm disabled:bg-gray-200 disabled:text-gray-400',
        backgroundColorClass
      ]"
    />
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";

const props = defineProps({
  modelValue: String,
  disabled: Boolean,
  backgroundColorClass: {
    type: String,
    default: "",
  },
  customCountries: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(["update:modelValue"]);

const defaultCountries = [
  { name: "Afghanistan", code: "+93", digits: 9 },
  { name: "Afrique du Sud", code: "+27", digits: 9 },
  { name: "Albanie", code: "+355", digits: 9 },
  { name: "Algérie", code: "+213", digits: 9 },
  { name: "Allemagne", code: "+49", digits: 11 },
  { name: "Arabie Saoudite", code: "+966", digits: 9 },
  { name: "Argentine", code: "+54", digits: 10 },
  { name: "Australie", code: "+61", digits: 9 },
  { name: "Autriche", code: "+43", digits: 10 },
  { name: "Belgique", code: "+32", digits: 9 },
  { name: "Bénin", code: "+229", digits: 8 },
  { name: "Burkina Faso", code: "+226", digits: 8 },
  { name: "Cameroun", code: "+237", digits: 9 },
  { name: "Canada", code: "+1", digits: 10 },
  { name: "Congo Brazzaville", code: "+242", digits: 8 },
  { name: "Congo RDC", code: "+243", digits: 9 },
  { name: "Côte d'Ivoire", code: "+225", digits: 10 },
  { name: "Espagne", code: "+34", digits: 9 },
  { name: "États-Unis", code: "+1", digits: 10 },
  { name: "France", code: "+33", digits: 9 },
  { name: "Gabon", code: "+241", digits: 7 },
  { name: "Ghana", code: "+233", digits: 9 },
  { name: "Guinée", code: "+224", digits: 8 },
  { name: "Italie", code: "+39", digits: 10 },
  { name: "Mali", code: "+223", digits: 8 },
  { name: "Nigeria", code: "+234", digits: 10 },
  { name: "Sénégal", code: "+221", digits: 9 },
  { name: "Togo", code: "+228", digits: 8 },
];


const countries = computed(() =>
  props.customCountries?.length ? props.customCountries : defaultCountries
);


const selectedCountry = ref(countries.value[0].code);


const selectedCountryData = computed(() =>
  countries.value.find((c) => c.code === selectedCountry.value)
);


const formattedNumber = ref("");


const generatedMask = computed(() => {
  if (!selectedCountryData.value) return "";
  return (
    selectedCountryData.value.code +
    " " +
    "•".repeat(selectedCountryData.value.digits)
  );
});


const clean = (v) => v.replace(/\D/g, "");

const onInput = (e) => {
  const raw = clean(e.target.value);
  const max = selectedCountryData.value?.digits ?? 0;

  const trimmed = raw.slice(0, max);

  formattedNumber.value = trimmed;


  emit("update:modelValue", selectedCountryData.value.code + trimmed);
};


const onKeyPress = (e) => {
  if (!/[0-9]/.test(e.key)) e.preventDefault();
};


const onKeyDown = (e) => {
  const allowed = ["Backspace", "Delete", "ArrowLeft", "ArrowRight", "Tab"];
  if (!allowed.includes(e.key) && !/[0-9]/.test(e.key)) e.preventDefault();
};

// Gestion du coller
const onPaste = (e) => {
  const text = clean(e.clipboardData.getData("text"));
  const max = selectedCountryData.value.digits;
  formattedNumber.value = text.slice(0, max);
};

// Réinitialiser
const resetNumber = () => {
  formattedNumber.value = "";
  emit("update:modelValue", "");
};

watch(
  () => props.modelValue,
  (val) => {
    if (!val) {
      formattedNumber.value = "";
      return;
    }
    const code = selectedCountryData.value.code;
    formattedNumber.value = clean(val.replace(code, ""));
  },
  { immediate: true }
);
</script>

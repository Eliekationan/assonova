<template>
  <div class="onboarding-page">
    <!-- Stepper simple -->
    <div class="stepper">
      <div
        v-for="(s, i) in steps"
        :key="i"
        :class="['step', { active: i === current }]"
      >{{ i + 1 }}</div>
    </div>

    <!-- Step dynamique -->
    <component
      :is="stepsComponents[current]"
      :form="form"
      :errors="form.errors"
      :processing="form.processing"
      @next="next"
      @prev="prev"
    />
  </div>
</template>

<script>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
// import debounce from 'lodash.debounce';
// import debounce from '@/Utils/debounce';

import Welcome from './Welcome.vue';
import AssociationInfo from './AssoInfo.vue';
import AdminInfo from './AdminInfo.vue';
import Finish from './Finish.vue';

export default {
  components: { Welcome, AssociationInfo, AdminInfo, Finish },

  setup() {
    const stepsComponents = [Welcome, AssociationInfo, AdminInfo, Finish];
    const steps = ["Welcome", "AssociationInfo", "AdminInfo", "Finish"];
    const current = ref(0);

    const form = useForm({
        name: "",
        acronym: "",
        object: "",
        description: "",
        email: "",
        phone: "",
        siege: "",
        admin_name: "",
        admin_email: "",
        admin_phone: "",
        password:"",
        president_name: "",
        president_phone: "",
      // ajoute tous tes champs existants ici
    });

    const next = () => {
      if (current.value < stepsComponents.length - 1) current.value++;
    };

    const prev = () => {
      if (current.value > 0) current.value--;
    };

    // Autosave draft
    // const debouncedSave = debounce(() => {
    //   form.patch('/onboarding/draft', {
    //     preserveState: true,
    //     preserveScroll: true
    //   });
    // }, 1200);

    // const onFieldChanged = () => {
    //   debouncedSave();
    // };

    // Finish -> envoi final
    // const finish = () => {
    //   form.post('/onboarding/store', {
    //     onError: (errors) => {
    //       alert(errors)
    //     },
    //     onSuccess: () => {
    //       console.log("Onboarding terminé !");
    //     }
    //   });
    // };

    return {
      steps,
      stepsComponents,
      current,
      form,
      next,
      prev,
    //   finish
    };
  }
};
</script>

<style scoped>
.stepper { display:flex; gap:10px; margin-bottom:20px; }
.step { width:32px; height:32px; border-radius:50%; background:#e6e6e6; display:flex; align-items:center; justify-content:center; }
.step.active { background:#1c6279; color:white; }
.onboarding-page{ padding:20px; display:flex; flex-direction:column; align-items:center; }
</style>

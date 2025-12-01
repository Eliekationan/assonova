<template>
  <component
    :is="steps[current]"
    :form="form"
    @next="next"
    @prev="prev"
  />
</template>

<script>
import Welcome from './Welcome.vue';
import AssociationInfo from './AssoInfo.vue';
import AdminInfo from './AdminInfo.vue';
import Finish from './Finish.vue';

export default {
    components: {
        Welcome,
        AssociationInfo,
        AdminInfo,
        Finish
    },

  data() {
    return {
      current: 0,
      steps: ["Welcome", "AssociationInfo", "AdminInfo", "Finish"],
      form: {
        // toutes les données
      }
    };
  },

  methods: {
    next() { this.current++ },
    prev() { this.current-- }
  }
};
</script>

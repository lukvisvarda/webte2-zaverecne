<template>
  <div class="language-switcher">

    <select @change="switchLanguage($event)" class="form-select form-select my-3" aria-label=".form-select-sm example">
      <option value="sk">sk</option>
      <option value="en">en</option>
    </select>
  </div>
</template>

<script>
export default {
  methods: {
    switchLanguage(event) {
      this.$i18n.locale = event.target.value;
    },
  },
};
</script>

<style scoped>

</style>

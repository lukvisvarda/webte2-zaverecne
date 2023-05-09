<template>

</template>

<script>
import { useRoute } from "vue-router";
import {computed} from "vue";
export default {
  name: "StudentOverview",
  setup(){
    const route = useRoute();
    const userId = computed(() => route.params.id).value;
    return {
      userId
    };
  }
}
</script>

<style>

</style>

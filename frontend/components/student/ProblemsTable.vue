<template>
  <div>
    <vue-good-table :columns="columns" :rows="rows" style="margin-left: 50px; margin-right: 50px; margin-top: 50px">
      <template v-slot:table-row="props">
        <span v-if="props.column.field === 'name_problem' || props.column.field === 'submited' || props.column.field === 'max_points' || props.column.field === 'points'">{{ props.formattedRow[props.column.field] }}</span>
        <span v-if="props.column.field === 'action' && props.formattedRow['submitted'] === 'Neodovzdané'">
            <RouterLink :to="`/students/problem/${props.formattedRow['id']}`" class="btn btn-primary" >Riešiť</RouterLink>
          </span>
        <span v-if="props.column.field === 'task'">
          <Task :zadanie="props.formattedRow[props.column.field]"></Task>
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import api from "../../utils/api";
import {PROBLEM_BY_USER_GET} from "../../constants/edpoints";
import {VueGoodTable} from "vue-good-table-next";
import Task from "../latex/Task.vue";

export default {

  components: {VueGoodTable, Task},

  props: {
    rows: {
      type: Array,
      default: () => [],
      required: true
    },
  },

  data() {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id',
        },
        {
          label: this.$t("problemstable.file_name"),
          field: 'name_problem',
        },
        {
          label: this.$t("problemstable.Task"),
          field: 'task',
        },
        {
          label: this.$t("problemstable.Submit"),
          field: 'submitted',
        },
        {
          label: this.$t("problemstable.Max"),
          field: 'max_points',
        },
        {
          label: this.$t("problemstable.pts"),
          field: 'points',
        },
        {
          label: this.$t("problemstable.act"),
          field: 'action',
        },
      ],
    }
  },

}
</script>

<style scoped>

</style>

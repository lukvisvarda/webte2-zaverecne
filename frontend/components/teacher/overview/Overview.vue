<template>
  <div>
    <div v-if="isLoading" class="loading">
      <VueSpinnerHourglass :size="100" color="#0d6efd"/>
    </div>
    <div v-else>
      <vue-good-table :columns="columns" :rows="rows" style="margin-left: 50px; margin-right: 50px; margin-top: 50px">
        <template v-slot:table-row="props">
          <span v-if="props.column.field === 'action'">
            <RouterLink :to="`/teacher/student/${props.formattedRow['id']}`" class="btn btn-primary" >Zobraziť študenta</RouterLink>
          </span>
          <span v-else>{{ props.formattedRow[props.column.field] }}</span>
        </template>
      </vue-good-table>
      <button class="btn btn-primary" @click="exportTableToCSV">CSV</button>
    </div>
  </div>
</template>

<script>
import { VueGoodTable } from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css';
import {CSV_POST, PROBLEM_BY_USER_GET, STUDENT_GET} from "../../../constants/edpoints";
import api from "../../../utils/api";
import { VueSpinnerHourglass } from 'vue3-spinners'
// import JsonCSV from 'vue-json-csv'
import FileSaver from 'file-saver'
import {defineAsyncComponent} from "vue";
const JsonCSV = defineAsyncComponent(() => import('vue-json-csv'));

export default {
  components: {
    VueGoodTable,
    VueSpinnerHourglass,
    JsonCSV
  },

  mounted(){
    this.fetchData();
  },

  data() {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id',
        },
        {
          label: 'Meno',
          field: 'name',
        },
        {
          label: 'Email',
          field: 'email',
        },
        {
          label: 'Akcia',
          field: 'action',
        },
        {
          label: 'Počet vygenerovaných úloh',
          field: 'counter_generation'
        },
        {
          label: 'Počet odovzdaných',
          field: 'counter_submitted'
        },
        {
          label: 'Počet bodov',
          field: 'points_earned'
        }

      ],
      rows: [],
      isLoading: true,
    };
  },

  computed: {
    rowJson(){
      return JSON.stringify(this.rows);
    }
  },

  methods: {
    async fetchData(){
      const response = await api.get(STUDENT_GET);

      console.log(response);

      for(let i = 0; i < response.length; i++) {
        const response2 = await api.get(PROBLEM_BY_USER_GET(response[i].id));
        const pocetVygenerovanych = response2.length;
        const pocetOdovzdanych = response2.filter(item => item.submitted === 1).length;
        const pocetBodov = response2.reduce((prev, current) => prev + current.points, 0);
        this.rows.push({
          id: response[i].id,
          name: response[i].name,
          email: response[i].email,
          counter_generation: pocetVygenerovanych,
          counter_submitted: pocetOdovzdanych,
          points_earned: pocetBodov
        });
      }

      this.isLoading = false;

    },
    async exportTableToCSV() {

      const response = await api.post(CSV_POST, this.rows)
      console.log(response);
      const blob = new Blob([response], { type: 'text/csv;charset=utf-8;' });
      FileSaver.saveAs(blob, 'table-data.csv');
    }
  }
}

</script>

<style>
.loading{
  height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>

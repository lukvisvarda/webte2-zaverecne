<template>
  <div>
    <div v-if="isLoading" class="loading">
      <VueSpinnerHourglass :size="100" color="#0d6efd"/>
    </div>
    <div v-else>
      <vue-good-table :columns="columns" :rows="rows" style="margin-left: 50px; margin-right: 50px; margin-top: 50px">
        <template v-slot:table-row="props">
          <span v-if="props.column.field === 'id' || props.column.field === 'name' || props.column.field === 'surname'">{{ props.formattedRow[props.column.field] }}</span>
          <span v-if="props.column.field === 'action'">
            <RouterLink :to="`/teacher/student/${props.formattedRow['id']}`" class="btn btn-primary" >Zobraziť študenta</RouterLink>
          </span>
        </template>
      </vue-good-table>
    </div>
  </div>
</template>

<script>
import { VueGoodTable } from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css';
import {STUDENT_GET} from "../../../constants/edpoints";
import api from "../../../utils/api";
import { VueSpinnerHourglass } from 'vue3-spinners'


export default {
  components: {
    VueGoodTable,
    VueSpinnerHourglass
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
      ],
      rows: [],
      isLoading: true
    };
  },

  methods: {
    async fetchData(){
      const response = await api.get(STUDENT_GET);

      console.log(response);

      for(let i = 0; i < response.length; i++) {
        this.rows.push({
          id: response[i].id,
          name: response[i].name,
          email: response[i].email,
        });
      }

      this.isLoading = false;

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

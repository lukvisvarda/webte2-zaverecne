<template>
  <div>
    <div v-if="isLoading" class="loading">
      <VueSpinnerHourglass :size="100" color="#0d6efd"/>
    </div>
    <div v-else>
      <h1>{{ userName }}</h1>
      <vue-good-table :columns="columns" :rows="rows" style="margin-left: 50px; margin-right: 50px; margin-top: 50px">
        <template v-slot:table-row="props">
          <span>{{ props.formattedRow[props.column.field] }}</span>
        </template>
      </vue-good-table>
    </div>
  </div>
</template>

<script>
import { useRoute } from "vue-router";
import {computed} from "vue";
import api from "../../../utils/api";
import {GET_USER_BY_ID, PROBLEM_BY_USER_GET} from "../../../constants/edpoints";
import {VueGoodTable} from "vue-good-table-next";
import {VueSpinnerHourglass} from "vue3-spinners";
export default {
  name: "StudentOverview",

  components: {
    VueGoodTable,
    VueSpinnerHourglass
  },
  data(){
    return{
      columns: [ //submitted, pocet bodov, max pocet bodov, id priklad
        {
          label: 'Názov príkladu',
          field: 'name_problem',
        },
        {
          label: 'Odovzdané',
          field: 'submitted',
        },
        {
          label: 'Maximálny počet bodov',
          field: 'max_points',
        },
        {
          label: 'Počet bodov',
          field: 'points',
        },
      ],
      rows: [],
      userName: "",
      isLoading: true,
    }
  },

  setup(){
    const route = useRoute();
    const userId = computed(() => route.params.id).value;
    return {
      userId,
    };
  },

  mounted() {
    this.fetchData();
  },

  methods: {
    async fetchData() {
      // return ["problem" => $problem->problem,
      //   "solved"=> $problem->solved,
      //   "maxPoints"=>$problem->max_points,
      //   "points" => $problem->points,
      //   "submitted" => $problem->submitted];
      const response = await api.get(PROBLEM_BY_USER_GET(this.userId));
      for(let i = 0; i < response.length; i++){
        this.rows.push({
          name_problem: response[i].problem.name,
          submitted: response[i].submitted !== 0 ? "Odovzdané" : "Neodovzdané",
          max_points: response[i].maxPoints,
          points: response[i].points,
        })
      }

      const response2 = await api.get(GET_USER_BY_ID(this.userId));

      this.userName = response2.name
      this.isLoading = false;
    }
  }
}
</script>

<style>
  h1 {
    margin-top: 40px ;
  }
</style>

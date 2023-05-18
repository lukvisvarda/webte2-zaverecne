<template>
<div class="mt-5 ">

    <div class="centered">
      <div class="select">

        <label for="example-select">Vyberte príklady:</label>
        <VueMultiselect
          v-model="selectedOptions"
          :options="options"
          :multiple="true"
          :taggable="true"
          @tag="addTag"
          :tag-placeholder="$t('tag.addTag')"
          :placeholder="$t('tag.placeholder')"
          label="name"
          track-by="code"
          @select="optionSelected"
          @remove="removeTag"
        ></VueMultiselect>
        <button type="button" class="btn btn-outline-success" @click="generate"> {{ $t('content.generate') }} </button>
      </div>
    </div>

    <!-- <button @click="generateExamples">Generovať</button> -->
  </div>
  <problems-table :rows="rows"></problems-table>
</template>

<script>
import api from "../../utils/api";
import {ASSIGN_GET, GENERATE_POST, PROBLEM_BY_USER_GET} from "../../constants/edpoints";
import {useToast} from "vue-toastification";
import ProblemsTable from "./ProblemsTable.vue";
import VueMultiselect from "vue-multiselect";
import { reactive } from "vue";


export default {
  name: "StudentsPage",
  components: { ProblemsTable, VueMultiselect },

  setup() {
    const toast = useToast();
    let selectedOptions = reactive([]);

    const addTag = (newTag) => {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      selectedOptions.push(tag);
      // props.handleChange(selectedOptions);
    };

    const optionSelected = (selectedOption) => {
      console.log(selectedOption);
      if (selectedOption.$isTag) {
        addTag(selectedOption.label);
      } else {
        selectedOptions.push(selectedOption);
      }
    };

    const removeTag = (tag) => {
      console.log(tag);
      // const index = selectedOptions.indexOf(tag)
      const found = selectedOptions.find((option) => option.name === tag.name);
      const index = selectedOptions.indexOf(found);
      if (index !== -1) {
        selectedOptions.splice(index, 1);
      }
  }
    return {
      toastErr: function (msg) {
        toast.error(msg)
      },
      toastSuccess: function (msg) {
        toast.success(msg)
      },
      selectedOptions,
      addTag,
      optionSelected,
      removeTag,
    }
  },

  data() {
    return {
      rows: [],
      options: [],
      selectedOptions: [],
    }
  },

  mounted() {
    this.getProblems();
    this.getAssignedThesis();
  },

  methods: {
    async generate() {
      console.log(this.selectedOptions);
      const problem = await api.post(GENERATE_POST, {
        problems: this.selectedOptions,
      });
      if(problem.message){
        this.toastErr(problem.message);
        return;
      }
      this.toastSuccess("Úloha bola vygenerovaná");
      await this.getProblems();
      // if there are no tasks to generate, return

    },

    // getSelectedOptions(selectedOptions) {
    //   this.selectedOptions = selectedOptions;
    //   console.log(selectedOptions, "AAAAaaaaaasssfsef");
    // },

    async getAssignedThesis() {
      const response = await api.get(ASSIGN_GET);
      if (response.selectedFiles) {
        for (let i = 0; i < response.selectedFiles.length; i++) {
          // this.selectedOptions.push(response.selectedFiles[i]);
          this.options.push({
          name: response.selectedFiles[i],
          code: response.selectedFiles[i],
        });
        }
      }
    },

    async getProblems() {
      this.rows = [];
      const problems = await api.get(PROBLEM_BY_USER_GET(this.$store.getters.getUser.id))
      console.log(JSON.stringify(problems));
      for(let i = 0; i < problems.length; i++){
        this.rows.push({
          id: problems[i].problem.id,
          name_problem: problems[i].problem.name,
          task: problems[i].problem.task,
          submitted: problems[i].submitted !== 0 ? "Odovzdané" : "Neodovzdané",
          max_points: problems[i].maxPoints,
          points:problems[i].points,
        })
      }
    },
  },
}



</script>

<style scoped>
.centered {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}


</style>

<template>
  <div class="select">
    <label for="example-select">Vyberte príklady:</label>
    <VueMultiselect
      v-model="selectedOptions"
      :options="options"
      :multiple="true"
      :taggable="true"
      @tag="addTag"
      tag-placeholder="Add this as new tag"
      placeholder="Type to search or add tag"
      label="name"
      track-by="code"
      @select="optionSelected"
      @remove="removeTag"
    ></VueMultiselect>
    <!-- <button @click="generateExamples">Generovať</button> -->
    <button type="button" class="btn btn-outline-success float-right" @click="generate"> {{ $t('content.generate') }} </button>
  </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";
// import { useToast } from "vue-toastification";
import { reactive } from "vue";



export default {
  components: {
    VueMultiselect,
  },

  props: {
    options: {
      type: Array,
      required: true,
    },
    handleChange: {
      type: Function,
      required: true,
    },
  },

  setup(props) {
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
      // props.handleChange(selectedOptions);
    };



    return {
      // options,
      selectedOptions,
      addTag,
      optionSelected,
      // submitSelection,
      handleChange: props.handleChange,
      removeTag,
    };
  },


  watch: {
    selectedOptions: {
      handler(newArray, oldArray) {
        // Handle the array change here
        this.handleChange(newArray);
        console.log('Array changed:', newArray);
      },
      deep: true, // Watch for nested changes within the array
    },
  },

  methods: {
    async generate() {
      console.log(this.selectedOptions);
      // const problem = await api.post(GENERATE_POST, {
      //   problems: this.selectedOptions,
      // });
      // if(problem.message){
      //   this.toastErr("Nemáte žiadne úlohy na vygenerovanie");
      //   return;
      // }
      // this.toastSuccess("Úloha bola vygenerovaná");
      // await this.getProblems();
      //if there are no tasks to generate, return

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
};
</script>

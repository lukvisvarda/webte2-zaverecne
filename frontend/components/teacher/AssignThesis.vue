<template>
  <div class="select">
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
    />
    <button class="btn btn-primary select-button" @click="submitSelection()">Potvrdiť</button>
  </div>
</template>
<script>
import VueMultiselect from 'vue-multiselect'
import api from "../../utils/api";
import {LATEX_GET} from "../../constants/edpoints";
import {reactive} from "vue";
export default {
  name: "AssignThesis",
  components: {VueMultiselect},

  setup() {
    const options = reactive([]);
    const selectedOptions = reactive([]);

    api.get(LATEX_GET)
      .then(response => {
        // Clear options array before pushing new values
        options.splice(0, options.length);
        //loop through the response and push the data to the options array
        for (let i = 0; i < response.length; i++) {
          // loop over parsed data and push to options array
          options.push({
            name: response[i].name,
            code: response[i].name
          });
        }
      });

    const addTag = (newTag) => {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      options.push(tag)
      selectedOptions.push(tag)
    };

    const optionSelected = (selectedOption) => {
      if (selectedOption.$isTag) {
        addTag(selectedOption.label);
      } else {
        selectedOptions.push(selectedOption);
      }
    }

    const removeTag = (tag) => {
      const index = selectedOptions.indexOf(tag)
      if (index !== -1) {
        selectedOptions.splice(index, 1)
      }
    }

    const submitSelection = () => {
      console.log("WATAFAAAK",selectedOptions);
    };

    return {
      options,
      selectedOptions,
      addTag,
      optionSelected,
      submitSelection,
      removeTag
    };
  },
}

</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style>
  .select {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 400px;
    flex-direction: column;
    margin: 0 auto;
  }
  .select-button{
    width:100%;
    margin-bottom: 2rem
  }
</style>

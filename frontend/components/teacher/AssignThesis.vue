<template>
  <div class="select">
    <label class="mb-2">Vyber príklady na generovanie</label>
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
    <button class="btn btn-dark select-button" @click="submitSelection()">
      Potvrdiť
    </button>
  </div>
</template>
<script>
import VueMultiselect from "vue-multiselect";
import api from "../../utils/api";
import { ASSIGN_POST } from "../../constants/edpoints";
import { reactive } from "vue";
import { useToast } from "vue-toastification";

export default {
  name: "AssignThesis",
  components: { VueMultiselect },

  props: {
    options: {
      type: Array,
      required: true,
    },
    initialSelectedOptions: {
      type: Array,
      required: true,
    },
  },

  setup(props) {
    const toast = useToast();
    console.log(props.initialSelectedOptions, "ASUJIODGBASOUIDG");
    // const options = reactive([]);
    let selectedOptions = reactive([]);

    const addTag = (newTag) => {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      selectedOptions.push(tag);
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
    };

    const submitSelection = () => {
      // console.log(this.selectedOptions.map(option => option.name))
      api
        .post(ASSIGN_POST, {
          selectedOptions: selectedOptions.map((option) => option.name),
        })
        .then((response) => {
          console.log(response);
          toast.success(response.message);
        })
        .catch((error) => {
          toast.error(error.message);
        });
    };

    props.initialSelectedOptions.forEach((option) => {
      optionSelected({
        name: option,
        code: option,
      });
    });

    return {
      // options,
      selectedOptions,
      addTag,
      optionSelected,
      submitSelection,
      removeTag,
    };
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style>
.select-button {
  width: 100%;
}
</style>

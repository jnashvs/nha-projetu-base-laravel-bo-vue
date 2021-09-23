<!-- Vue component -->
<template>
<div>
<div class="form-group row">
  <input type="hidden" :name="inputName" :value="JSON.stringify(form.extensions)">
  </div>

      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Extensão</label>
        <div class="col-sm-6">
          <multiselect
            :value="form.extensions"
            v-model="form.extensions"
            tag-placeholder="Add this as new tag"
            placeholder="Search or add a tag"
            label="name"
            track-by="code"
            :options="options"
            :multiple="true"
            :taggable="true"
            @tag="addTag"
          ></multiselect>
          <small v-if="errors" class="bo-campos-obrigatorios">
            <span v-for="(extensions, index) in errors.extensions" :key="index">{{extensions}}</span>
          </small>
        </div>
      </div>
      </div>
</template>

<script>
import Multiselect from "vue-multiselect";

// register globally
Vue.component("multiselect", Multiselect);

export default {
  // OR register locally
  components: { Multiselect },
  props:{
    inputName: String,
    data: {
      //type: Object
    },
    errors: {
    },
  },
  data() {
    return {
      value: [],
      options: [
        { name: "image/*", code: "img" },
        { name: "image/jpg", code: "jpg" },
        { name: "image/jpeg", code: "jpeg" },
        { name: "image/gif", code: "gif" },
        { name: "image/png", code: "png" },
        { name: "application/doc", code: "doc" },
        { name: "application/docx", code: "docx" },
        { name: "application/pdf", code: "pdf" },
        { name: "application/xls", code: "xls" },
        { name: "application/xlsx", code: "xlsx" },
        { name: "application/csv", code: "csv" },
      ],
      form: {
        extensions: '',
      },
      emptyForm: {
        extensions: '',
      }
    };
  },
  methods: {
    addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
      };
      this.options.push(tag);
      this.value.push(tag);
    },
  },
  mounted(){
    if(this.data){
      this.form = JSON.parse(this.data);
      console.log(this.form);
    }
  }
};
</script>

<!-- New step!
     Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
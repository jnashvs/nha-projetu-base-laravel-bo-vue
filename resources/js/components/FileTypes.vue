<!-- Vue component -->
<template>
  <div class="file-types-container">
    <form @submit.prevent="onSubmit">
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Diretoria</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" v-model="form.directory"/>
          <!-- <small v-if="errors" class="campos-obrigatorios">
            <span v-for="(nome, index) in errors.nome" :key="index">{{nome}}</span>
          </small> -->
        </div>
      </div>

      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Título</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" v-model="form.title"/>
        </div>
      </div>

      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Extensão</label>
        <div class="col-sm-6">
          <multiselect
            name="file-type"
            :value="value"
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
        </div>
      </div>

      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Tam. Máximo</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" v-model="form.max_file_size"/>
        </div>
      </div>
      <br>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Guardar</button>
          <a :href="cancelurl" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Cancelar</a>
        </div>
      </div>
      
    </form>
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
    cancelurl: {
      type: String,
      required: true
    },
    data: {
      //type: Object
    },
  },
  data() {
    return {
      errors: [],
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
        id: '',
        directory: '',
        title: '',
        extensions: '',
        max_file_size: '',
      },
      emptyForm: {
        id: '',
        directory: '',
        title: '',
        extensions: '',
        max_file_size: '',
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
    onSubmit(){
      console.log(JSON.stringify(this.form));
      axios
        .post('http://127.0.0.1:8000/api/file-types/store', this.form)
        .then(function(response) {
          console.log(response)
        })
        .catch(e => {
          // if (errors.response.status == 422) {
          //     this.errors = errors.response.data.errors;
          // } else {
          //   console.log(errors.response.status);
          // }
        });

      this.form = this.emptyForm;
    }
  },
  mounted(){
    if(this.data){
      this.form = JSON.parse(this.data);
    }
  }
};
</script>

<!-- New step!
     Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
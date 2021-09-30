<template>
  <div class="form-group form-group main-test-bo-file-input">
    <label for>Bo file input</label>
    <div class="input-group">
      <input
        :name="inputName"
        type="text"
        v-bind:value="boFileInput"
        class="form-control"
        :placeholder="placeholder"
        aria-label="Recipient's username"
        aria-describedby="basic-addon2"
      />
      <div class="input-group-append">
        <a class="btn btn-primary" @click="showModal=true" type="button">
          <span>
            <i class="fa fa-folder-open" aria-hidden="true"></i>
          </span>
        </a>
        <a class="btn btn-danger" @click="clearInput" type="button">
          <span>
            <i class="fa fa-times" aria-hidden="true"></i>
          </span>
        </a>
      </div>
    </div>

  </div>
</template>

<script>
import ModalFiles from "../file-management/ModalFiles.vue";

export default {
  // OR register locally
  components: {
    ModalFiles,
  },
  props: {
    boFileInput: String,
    inputName: String,
    directory: String,
    placeholder: String
  },
  computed: {
    inputValue: function() {
      //return JSON.stringify(this.value);
      return this.value;
    }
  },
  data() {
    return {
      dir: this.directory,
      showModal: false,
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
        { name: "application/csv", code: "csv" }
      ]
    };
  },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    setInputValue(value) {
      console.log("setInputValue: " + value);
      this.boFileInput = value;
      //this.$emit('bo-file-input', value);

      this.closeModal();
    },
    clearInput() {
      console.log("clear triger");
      this.boFileInput = "";
    }
  }
};
</script>
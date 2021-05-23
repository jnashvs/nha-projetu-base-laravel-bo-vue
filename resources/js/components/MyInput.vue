<template>
  <div class="main-test">
    <span>
      <input class="form-control" name="my-input-text" type="text" :value="initPostcode" />
      <input class="form-control " name="input-hidden" type="hidden" :value="hiddenValue" />
    </span>
    <multiselect
      name="my-input-text2"
      v-model="value"
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
</template>

<script>
export default {
  props: {
    "init-postcode": {
      default: ""
    },
    "select-value": {
      default: ""
    }
  },
  computed: {
    hiddenValue: function () {
      return JSON.stringify(this.value);
    }
  },
  data() {
    return {
      showModal: false,
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
        { name: "application/csv", code: "csv" }
      ]
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
      console.log('add tag');
      //this.selectValue = tag;
    },
    closeModal(){
      this.showModal = false;
    }
  }
};
</script>
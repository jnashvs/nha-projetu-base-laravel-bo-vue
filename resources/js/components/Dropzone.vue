<template>
  <div class="container">
    <div class="row justify-content-center">

      <!-- active area -->
      <div class="col-sm-12" v-if="addFileArea">
        <div class="card">
          <div class="card-header">
            <label for class="mr-auto">Add files here</label>
            <!-- <button class="ml-auto pull-right" @click="cancelUpload">Cancel upload</button> -->
          </div>

          <div class="card-body">
            <vue-dropzone
              ref="myVueDropzone"
              id="dropzone"
              :options="dropzoneOptions"
              :duplicateCheck="true"
              v-on:vdropzone-sending="sendingEvent"
              v-on:vdropzone-complete="completeEvent"
            ></vue-dropzone>
          </div>
        </div>
      </div>
      <!-- end active area -->
      <div class="col-sm-12">
        <data-table :columns="columns" url="http://127.0.0.1:8000/api/files/all">
          <div slot="filters" slot-scope="{ tableFilters }">
            <div class="row mb-2">
              <div class="col-sm-6">
                <div class="form-row">
                  <div class="form-group">
                    <button @click="addFileArea = true" type="button" class="btn btn-primary">Add files</button>
                  </div>
                  <div class="form-group col-md-6">
                    <select
                    v-model="tableFilters.filters.isActive"
                    class="form-control">
                        <option value>All</option>
                        <option value='1'>type 111</option>
                        <option value='2'>type 2222</option>
                        <option value='3'>type 3333</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <input
                  name="name"
                  class="form-control"
                  v-model="tableFilters.search"
                  placeholder="Search Table"
                />
              </div>
            </div>
          </div>
        </data-table>
      </div>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import fileRightButton from "../components/fileRightButton.vue";

export default {
  components: {
    vueDropzone: vue2Dropzone,
    fileRightButton
  },
  data: function() {
    return {
      dropzoneOptions: {
        url: "http://127.0.0.1:8000/api/files/upload",
        thumbnailWidth: 100,
        maxFilesize: 2,
        maxFiles: 10,
        //acceptedFiles: ['image/png', 'image/*', 'application/pdf'],
        //acceptedFiles: ['application/pdf'],
        headers: { "My-Awesome-Header": "header value" }
        //addRemoveLinks: true
      },
      data: {},
      filters: {
        isActive: ""
      },
      addFileArea: false,
      columns: [
        {
          label: "ID",
          name: "id",
          orderable: true
        },
        {
          label: "Path",
          name: "path",
          orderable: true
        },
        {
          label: "Size",
          name: "size",
          orderable: true
        },
        {
          label: "",
          name: "View",
          orderable: false,
          classes: {
            btn: true,
            "btn-primary": true,
            "btn-sm": true
          },
          event: "click",
          handler: this.displayRow,
          component: fileRightButton
        }
      ],
      selectedRow: {},
      perPage: 1,
      tableProps: {
        search: "",
        length: 10,
        column: "id",
        dir: "asc"
      }
    };
  },
  methods: {
    completeEvent(response) {
      console.log(response);
      this.reloadTable(this.tableProps);
    },
    sendingEvent(file, xhr, formData) {
      formData.append("size", file.upload.total);
      console.log(JSON.stringify(file));
    },
    allFiles(options = this.tableProps) {
      var self = this;

      axios
        .get("http://127.0.0.1:8000/api/files/all", {
          params: options
        })
        .then(function(response) {
          self.data = response;
          this.allFiles();
        })
        .catch(function(error) {
          console.log(error);
          console.log("erorrr sim");
        });
    },
    reloadTable(tableProps) {
      this.allFiles();
    },
    displayRow(data) {
      console.log(JSON.stringify(data));
    }
  },
  mounted() {
    console.log("Component mounted.");
    this.allFiles();
  }
};
</script>

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
              v-on:vdropzone-complete="completeEvent"
            ></vue-dropzone>
          </div>
        </div>
      </div>
      <!-- end active area -->
      <div class="col-sm-12">
        <data-table ref="tablerefs" :columns="columns" :url="url">
          <div slot="filters" slot-scope="{ tableFilters }">
            <div class="row mb-2">
              <div class="col-sm-6">
                <div class="form-row">
                  <div class="form-group">
                    <button
                      @click="addFileArea = true"
                      type="button"
                      class="btn btn-primary"
                    >Add files</button>
                  </div>
                  <div class="form-group col-md-6">
                    <slot></slot>
                    <!-- aqui entra os select que são passados pelo slot -->
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

      <!-- <pre>
{{data}}
      </pre>-->

      <!-- end table listing -->
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
      url: "http://127.0.0.1:8000/api/files/all",
      plus: "",
      dropzoneOptions: {
        url: "http://127.0.0.1:8000/api/files/upload",
        thumbnailWidth: 100,
        maxFilesize: 2,
        maxFiles: 10,
        //acceptedFiles: [],
        acceptedFiles: this.extensionsFile,
        headers: { "My-Awesome-Header": "header value" }
        //addRemoveLinks: true
      },
      data: {},
      fileTypes: {},
      activeFileType: {},
      extensionsFile: [],
      activeFileTypeId: "",
      filters: {
        isActive: this.$route.query.directory || 999
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
    activeFileTypes(event) {
      var Id = event.target.value;

      var found = [];

      this.fileTypes.forEach(element => {
        if (element.id == Id) return (found = element);
      });

      if (found.extensions) {
        var list_extensions = JSON.parse(found.extensions);

        this.extensionsFile = [];

        list_extensions.forEach(element => {
          this.extensionsFile.push(element.name);
        });

        this.dropzoneOptions.acceptedFiles = this.extensionsFile;
      }

      //this.$set(this.dropzoneOptions,'acceptedFiles',this.extensionsFile);
    },
    allFilesTypes() {
      var self = this;

      axios
        .get("http://127.0.0.1:8000/api/file-types/all")
        .then(function(response) {
          self.fileTypes = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    completeEvent(response) {
      this.allFiles();

      // this.plus = this.plus == "/" ? "//" : "/";
      // this.url = this.url + this.plus;
    },
    // sendingEvent(file, xhr, formData) {
    //   formData.append("size", file.upload.total);
    //   console.log(JSON.stringify(file));
    // },
    allFiles(options = this.tableProps) {
      var self = this;

      axios
        .get(this.url, {
          params: options
        })
        .then(function(response) {
          self.data = response;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    reloadTable(tableProps) {
      //this.allFiles(tableProps);
    },
    displayRow(data) {
      //console.log(JSON.stringify(data));
    }
  },
  // computed: {
  //   data() {
  //     return this.data;
  //   }
  // },
  mounted() {
    this.allFiles();
    this.allFilesTypes();
  }
};
</script>

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
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="form-row">
              <div class="form-group">
                <button @click="addFileArea = true" type="button" class="btn btn-primary">Add files</button>
              </div>
              <div class="form-group col-md-6">
                <slot></slot>
                <!-- aqui entra os select que são passados pelo slot -->
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <input
              type="text"
              class="form-control"
              placeholder="Search Table"
              v-model="tableData.search"
              v-on:keyup.enter="getFiles()"
            />
          </div>
        </div>

        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          <tbody>
            <tr v-for="file in files" :key="file.id">
              <td>{{file.id}}</td>
              <td>
                <a target="_blank" :href="'../'+file.path">{{file.path}}</a>
              </td>
              <td>{{file.created_at}}</td>
              <td class="delete_td">
                <button class="btn btn-danger btn-xs" style="padding: 0px 6px;">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
            <tr v-if="files.length == 0">
              <td class="text-center" colspan="100%">Não foram encontrados nenhum ficheiro</td>
            </tr>
          </tbody>
        </datatable>
        <pagination
          :pagination="pagination"
          @prev="getFiles(pagination.prevPageUrl)"
          @next="getFiles(pagination.nextPageUrl)"
        ></pagination>

        <!-- end new TD -->
      </div>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import Datatable from "./Datatable.vue";
import Pagination from "./Pagination.vue";

export default {
  components: {
    vueDropzone: vue2Dropzone,
    datatable: Datatable,
    pagination: Pagination
  },
  data: function() {
    let sortOrders = {};
    let columns = [
      { width: "13%", label: "Id", name: "id" },
      { width: "66%", label: "Path", name: "path" },
      { width: "17%", label: "Data", name: "created_at" },
      { width: "3%", label: "", name: "" }
    ];
    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      //columns: ["id", "path", "size", "uri"],
      data: [],
      url: "/files/all",
      plus: "",
      dropzoneOptions: {
        url: `http://127.0.0.1:8000/api/files/upload?path=${this.$route.query.directory}`,
        thumbnailWidth: 100,
        maxFilesize: 2,
        maxFiles: 10,
        acceptedFiles: this.extensionsFile,
        headers: { "My-Awesome-Header": "header value" }
        //addRemoveLinks: true
      },
      fileTypes: {},
      activeFileType: {},
      extensionsFile: [],
      activeFileTypeId: "",
      addFileArea: false,
      files: [],
      columns: columns,
      sortKey: "id",
      sortOrders: sortOrders,
      perPage: ["10", "20", "30"],
      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 0,
        dir: "desc",
        file_type_slug: this.$route.query.directory
      },
      pagination: {
        lastPage: "",
        currentPage: "",
        total: "",
        lastPageUrl: "",
        nextPageUrl: "",
        prevPageUrl: "",
        from: "",
        to: ""
      }
    };
  },
  methods: {
    filterResult() {
      //Event.$emit('vue-tables.filter::mysearch', query);
      console.log("search fired");
    },
    clickUri(data) {
      console.log("click uri");
    },
    /*
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

    },*/
    allFilesTypes() {
      var self = this;

      axios
        .get("/file-types/all")
        .then(function(response) {
          self.fileTypes = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    completeEvent(response) {
      //this.allFiles();
      console.log("upload completed");
    },
    // sendingEvent(file, xhr, formData) { // event from dropzone plugin
    //   formData.append("size", file.upload.total);
    //   console.log(JSON.stringify(file));
    // },
    allFiles() {
      var self = this;
      axios
        .get(this.url, { params: this.params })
        .then(function(response) {
          self.data = response.data.data;

          console.log(JSON.stringify(response.data));
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getFiles(url = "/files/all") {
      this.tableData.draw++;
      axios
        .get(url, { params: this.tableData })
        .then(response => {
          let data = response.data;
          console.log(data);
          if (this.tableData.draw == data.draw) {
            this.files = data.data.data;
            this.configPagination(data.data);
          }
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    configPagination(data) {
      this.pagination.lastPage = data.last_page;
      this.pagination.currentPage = data.current_page;
      this.pagination.total = data.total;
      this.pagination.lastPageUrl = data.last_page_url;
      this.pagination.nextPageUrl = data.next_page_url;
      this.pagination.prevPageUrl = data.prev_page_url;
      this.pagination.from = data.from;
      this.pagination.to = data.to;
    },
    sortBy(key) {
      if(key){
        this.sortKey = key;
        this.sortOrders[key] = this.sortOrders[key] * -1;
        this.tableData.column = this.getIndex(this.columns, "name", key);
        this.tableData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
        this.getFiles();
      }
    },
    getIndex(array, key, value) {
      return array.findIndex(i => i[key] == value);
    }
  },
  mounted() {
    this.getFiles();
    //this.allFilesTypes();
  }
};
</script>

<template>
  <div>
    <div class="row pt-3 ml-3 mr-3 bg-info">
      <div class="col">
        <div class="row no-gutters">
          <div class="col-4">
            <div class="form-group">
              <label>Select Subject</label>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <select class="form-control form-control-sm" @change="fetchclass" v-model="subject">
                <optgroup label="Select subject">
                  <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{subject.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row no-gutters">
          <div class="col-4">
            <div class="form-group">
              <label>Select Class</label>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <select class="form-control form-control-sm" @change="search" v-model="classroom">
                <optgroup label="Select Class">
                  <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id" > {{classroom.name}} </option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row no-gutters">
          <div class="col-4">
            <div class="form-group">
              <label>Select Section</label>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <select class="form-control form-control-sm" @change="fetchmarks" v-model="section">
                <optgroup label="Select section">
                  <option value="">All</option>
                  <option v-for="section in sections" :key="section.id" :value="section.id">{{section.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <b-container fluid>
      <!-- User Interface controls -->
      <div class="row text-center">
        <div class="col">
          <label>Subject:</label>
          <label>{{subject.subject}}</label>
        </div>
        <div class="col">
          <label>Class: {{subject.classroom}}</label> &nbsp;
          <label>Section: {{subject.section}}</label>
        </div>
      </div>

      <b-row>
        <b-col md="6" class="my-1">
          <b-form-group label-cols-sm="3" label="Filter" class="mb-0">
            <b-input-group>
              <b-form-input v-model="filter" placeholder="Type to Search"></b-form-input>
              <b-input-group-append>
                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>

        <b-col md="6" class="my-1">
          <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
            <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
          </b-form-group>
        </b-col>
      </b-row>

      <!-- Main table element -->
      <b-table striped hover
        show-empty
        small
        stacked="md"
        :items="students"
        :fields="fields"
        :current-page="currentPage"
        :per-page="perPage"
        :filter="filter"
        :filterIncludedFields="filterOn"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        :sort-direction="sortDirection"
        @filtered="onFiltered"
      >
        <template v-slot:cell(actions)="row">
          <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
                         Info modal
          </b-button> -->
          <b-button
            size="sm"
            @click="row.toggleDetails"
          >{{ row.detailsShowing ? 'Cancel' : 'Edit' }}</b-button>
        </template>

        <template v-slot:row-details="row">
          <b-card>
            <div class="row">
              <div class="col">
                <label>Test One</label>
                <input
                  class="form-control"
                  :placeholder="row.item.testone"
                  v-model="testone[row.item.id]"
                  type="number"
                />
              </div>
              <div class="col">
                <label>Test Two</label>
                <input
                  class="form-control"
                  :placeholder="row.item.testtwo"
                  v-model="testtwo[row.item.id]"
                  type="number"
                />
              </div>
              <div class="col">
                <label>Test Three</label>
                <input
                  class="form-control"
                  :placeholder="row.item.testthree"
                  v-model="testthree[row.item.id]"
                  type="number"
                />
              </div>
              <div class="col">
                <label>Exam</label>
                <input
                  class="form-control"
                  :placeholder="row.item.exam"
                  v-model="exam[row.item.id]"
                  type="number"
                />
              </div>
            </div>

            <div class="row mt-3">
              <div class="col text-right">
                <button class="btn btn-outline-success" @click="saverecord(row.item)">Save</button>
              </div>
            </div>
          </b-card>
        </template>
      </b-table>

      <b-row>
        <b-col md="6" class="my-1">
          <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            class="my-0"
          ></b-pagination>
        </b-col>
      </b-row>

      <!-- get modal -->
      <!-- <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
        <pre>{{ infoModal.content.id }}</pre>
      </b-modal> -->
    </b-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subject: "",
      classrooms:'',
      classroom:'',
      sections:'',
      section:'',
      students:[],
      testone:[],
      testtwo:[],
      testthree:[],
      exam:[],
      fields: [
        {
          key: "student_name",
          label: "Student",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "testone",
          label: "Test One",
          sortable: true,
          class: "text-center"
        },
        {
          key: "testtwo",
          label: "Test Two",
          sortable: true,
          class: "text-center"
        },
        {
          key: "testthree",
          label: "Test Three",
          sortable: true,
          class: "text-center"
        },
        {
          key: "testave",
          label: "Test Average",
          sortable: true,
          class: "text-center"
        },
        { key: "exam", label: "Exam", sortable: true, class: "text-center" },
        {
          key: "cumulatve",
          label: "Cumulative",
          sortable: true,
          class: "text-center"
        },
        { key: "actions", label: "Actions" }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: "5",
      pageOptions: [5, 10, 15, 20],
      sortBy: '',
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: [],
      infoModal: {
        id: "info-modal",
        title: "",
        content: ""
      }
    };
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key };
        });
    },
      subjects(){
            return this.$store.state.subjects;
    },
    // rowno(){
    //      return this.totalRows = this.students.length
    // }

  },
  beforeUpdate() {
      this.totalRows = this.students.length
  },
  methods: {
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
    //   item.testone = "67"
      this.infoModal.content = item;
    //   this.infoModal.content.id = "66";

      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    saverecord(item){
        this.$Progress.start()
           let id = item.id;
            axios.post('/saverecord',{
                testone:this.testone[id],
                testtwo:this.testtwo[id],
                testthree:this.testthree[id],
                exam:this.exam[id],
                id:id
            })
            .then( response=> {
                item.testone = this.testone[id] == undefined || this.testone[id] == '' ? item.testone : this.testone[id]
                item.testtwo = this.testtwo[id] == undefined || this.testtwo[id] == '' ?  item.testtwo : this.testtwo[id]
                item.testthree = this.testthree[id] == undefined || this.testthree[id] == '' ?  item.testthree : this.testthree[id]
                item.exam = this.exam[id] == undefined || this.exam[id] == '' ? item.exam : this.exam[id]
                this.$bvToast.toast("Record(s) saved!",{
                    title: 'Success',
                    variant:'success',
                    solid: true
                });
            })
            .catch((e)=>{
                console.log(e)
            // this.$bvToast.toast("Check your input fields", {
            // title: "Error",
            // variant: "danger",
            // solid: true
        //   });
        })
        this.$Progress.finish()
        },

    //class and section
    search(){
        this.$Progress.start()
        axios.get('search/'+this.classroom)
        .then(({data}) => this.sections = data)
        this.fetchmarks();
        this.$Progress.finish()
    },
    fetchmarks(){
        this.$Progress.start()
        axios.get('/fetchmarks/', {
            params:{
                subject: this.subject,
                classroom:this.classroom,
                section:this.section
            }
        })
        .then((response)=>{
           this.students = response.data
        })
        .catch(() => {
            this.$bvToast.toast("contact the admin",{
                title:"Error",
                variant:"danger",
                solid: true
            });
        })
         this.totalRows = this.students.length
         this.$Progress.finish()
    },
     fetchclass(){
         this.$Progress.start()
        axios.get("fetchclass/"+this.subject)
        .then(({data}) => this.classrooms = data)
        .catch(() => {
            this.$bvToast.toast("No class takes this subject yet",{
                title:"Error",
                variant:'danger',
                solid:true
            });
        })
        this.fetchmarks();
        this.$Progress.finish()
    },

  },
  created() {

  },
};
</script>

<style>
</style>

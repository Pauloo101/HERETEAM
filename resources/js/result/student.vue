<template>
  <div>
    <div class="row pt-3 ml-3 mr-3 bg-secondary">
      <div class="col-5">
        <div class="row no-gutters">
          <div class="col-3">
            <div class="form-group">
              <label>Search by</label>
            </div>
          </div>
          <div class="col">
            <div class="field">
               <v-select
               class="bg-light"
                  label="name"
                  :filterable="false"
                  v-model="student"
                  @input="getrecords"
                  @search="searchstudent"
                  :options="students"
                >
                <template slot="no-options">
                    Enter the name of the students
                </template>
                <template slot="option" slot-scope="option">
                    <div class="text-center">
                        {{option.first_name}} {{option.surname}}
                    </div>
                </template>
                <template slot="selected-option" slot-scope="option">
                    <div class="text-center">
                        {{option.first_name}} {{option.surname}}
                    </div>
                </template>
                </v-select>
              <div class="input-group-append mt-3">
                <button class="btn btn-info" type="submit" :disabled="fetchbtn" @click="getrecords"> fetch result
                  <i class="fa fa-download ml-2"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="callout callout-success bg-light">
          <h6>
            <i class="fa fa-info p-0"></i>
            Student Info
          </h6>
          <div v-if="student != null">
          <label class="p-0 mr-3">Matric_no: {{student.matric_no ? student.matric_no : '----'}}</label>
          <label class="p-0 mr-3">First Name: {{student.first_name ? student.first_name: '----'}}</label>
          <label class="p-0 mr-3">Surname: {{student.surname ? student.surname: '----'}}</label>
          <label class="p-0 mr-3">gender: {{student.gender ? student.gender: '----'}}</label>
          <label class="p-0 mr-3">Class: {{student.classroom ? student.classroom : '----'}} </label>
          <label class="p-0 mr-1">section: {{student.section ? student.section : '----'}} </label>
          </div>
          <div v-else>
              <label class="text-danger">No student Selected</label>
          </div>

        </div>
      </div>
    </div>

    <b-container fluid class="shadow">
      <!-- User Interface controls -->
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
        :items="subjects"
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
          </b-button>-->
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
      <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
        <pre>{{ infoModal.content }}</pre>
      </b-modal>
    </b-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subject: "",
      subjects:[],
      student:null,
      students:[],
      testone:[],
      testtwo:[],
      testthree:[],
      exam:[],
      fields: [
        {
          key: "subject",
          label: "Subject",
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
      filterOn:[],
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
    fetchbtn(){
        if (this.student == null) {
            return true
        }
        else{
            return false
        }
    }
  },
  beforeUpdate() {
      this.totalRows = this.subjects.length
  },
  methods: {
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
      this.infoModal.content = item;
      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
      this.newquantity = "";
      this.newprice = "";
    },
    resetdeleteModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
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
            .then( response =>{
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
            .catch(()=>{
            this.$bvToast.toast("Check your input fields", {
            title: "Error",
            variant: "danger",
            solid: true
          });
            })
            this.$Prgress.finish()
        },
    searchstudent(search, loading){
        this.$Progress.start()
        loading(true);
       axios.get('/searchstudent', {
           params: {
               search : search
           }
       })
       .then((response) => {
            this.students =response.data
           loading(false);
       }
       )
       .catch((e) => {
           console.log(e)
       })
       this.$Progress.finish()
    //    loading(false);
    },
    getrecords(){
        axios.get('/getrecords' ,{
            params:{
                student_id: this.student.id
            }
        })
        .then(({data}) => this.subjects = data)
        .catch((e)=>{
            console.log(e)
        })
    }

  }
};
</script>

<style>
</style>

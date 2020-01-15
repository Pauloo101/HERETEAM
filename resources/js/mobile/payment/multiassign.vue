<template>
  <div>
    <div role="tablist" id="accordion-1">
      <div class="card">
        <div class="card-header" role="tab">
          <h5 class="mb-0">
            <a
              data-toggle="collapse"
              aria-expanded="true"
              aria-controls="accordion-1 .item-1"
              href="div#accordion-1 .item-1"
            >Advance Assign</a>
          </h5>
        </div>
        <div class="collapse show item-1" role="tabpanel" data-parent="#accordion-1">
          <div class="row mt-2 ml-1">
            <div class="col-2">
              <div class="card">
                <div class="card-header">
                  Select Bill
                  <div class="card-tools">
                    <button class="btn btn-sm btn-outline-info" @click="clearbill">clear</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Select Class</label>
                    <select
                      class="form-control form-control-sm"
                      @change="fecthbill"
                      v-model="classroom"
                    >
                      <option v-for="c in classrooms" :key="c.id" :value="c.id">{{c.name}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Select bill</label>
                    <select class="form-control form-control-sm" v-model="bill">
                      <option v-for="p in payment" :key="p.id" :value="p.id">{{p.name}}</option>
                    </select>
                  </div>
                  <div class="form-group p-0">
                    <label>Select student section</label>
                    <select class="form-control form-control-sm" v-model="section">
                      <optgroup label="Select Section">
                        <option>all</option>
                        <option v-for="s in sections" :key="s.id" :value="s.id">{{s.name}}</option>
                      </optgroup>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-sm btn-success" @click="fetchunassigned">Fetch Student</button>
                </div>
              </div>
            </div>
            <div class="col-10">
              <div class="card">
                <div class="card-header">
                  Select Student
                  <div class="card-tools">
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      @click="assign('all')"
                    >Assign all</button>
                    <button class="btn btn-sm btn-success" @click="saveassign">Save</button>
                  </div>
                </div>
                <div class="card-body">
                  <!-- <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Matric_NO</th>
                          <th>Surname</th>
                          <th>First Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="s in students" :key="s.id">
                          <td>{{s.matric_no}}</td>
                          <td>{{s.surname}}</td>
                          <td>{{s.first_name}}</td>
                          <td>
                            <button class="btn btn-sm btn-danger" v-if="s.assign == 0" @click="assign(s)">
                              <i class="fas fa-times"></i>
                            </button>
                            <button class="btn btn-sm btn-success" @click="unassign(s)" v-else>
                                <i class="fas fa-check-square"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                  </table>-->
                  <!-- </div> -->

                  <div class="col">
                    <b-row>
                      <b-col lg="6" class="my-1">
                        <b-form-group
                          label="Filter"
                          label-cols-sm="3"
                          label-align-sm="right"
                          label-size="sm"
                          label-for="filterInput"
                          class="mb-0"
                        >
                          <b-input-group size="sm">
                            <b-form-input
                              v-model="filter"
                              type="search"
                              id="filterInput"
                              placeholder="Type to Search"
                            ></b-form-input>
                            <b-input-group-append>
                              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                            </b-input-group-append>
                          </b-input-group>
                        </b-form-group>
                      </b-col>

                      <b-col sm="5" md="6" class="my-1">
                        <b-form-group
                          label="Per page"
                          label-cols-sm="6"
                          label-cols-md="4"
                          label-cols-lg="3"
                          label-align-sm="right"
                          label-size="sm"
                          label-for="perPageSelect"
                          class="mb-0"
                        >
                          <b-form-select
                            v-model="perPage"
                            id="perPageSelect"
                            size="sm"
                            :options="pageOptions"
                          ></b-form-select>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-table
                      head-variant="dark"
                      :busy="loading"
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
                      <template v-slot:table-busy>
                        <div class="text-center text-danger my-2">
                          <b-spinner class="align-middle"></b-spinner>
                          <strong>Loading...</strong>
                        </div>
                      </template>

                      <template v-slot:cell(actions)="row">
                        <button
                          class="btn btn-sm btn-danger"
                          v-if="row.item.assign == 0"
                          @click="assign(row.item)"
                        >
                          <i class="fas fa-times"></i>
                        </button>
                        <button class="btn btn-sm btn-success" @click="unassign(row.item)" v-else>
                          <i class="fas fa-check-square"></i>
                        </button>

                      </template>

                      <template v-slot:row-details="row">
                        <b-card></b-card>
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
                        <!-- <p>{{students}}</p> -->
                      </b-col>
                    </b-row>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      classroom: "",
      payment: "",
      bill: "",
      studclass: "",
      sections: "",
      section: "",
      students: [],
      fields: [
        {
          key: "matric_no",
          label: "Matric",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "first_name",
          label: "First Name",
          sortable: true,
          class: "text-center"
        },
        {
          key: "surname",
          label: "Surname",
          sortable: true,
          class: "text-center"
        },
        {
          key: "other_name",
          label: "Other Name",
          sortable: true,
          class: "text-center"
        },

        { key: "actions", label: "Actions" }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15],
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: []
    };
  },
  computed: {
    classrooms() {
      return this.$store.state.classrooms;
    },
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key };
        });
    }
  },
  methods: {
    fetchunassigned() {
      this.$Progress.start();
      this.loading=true
      this.students  = []
      axios
        .get("/fetchunassigned", {
          params: { bill: this.bill, classroom: this.classroom }
        })
        .then(response => {
          let source = { assign: 0 };
          let payment = response.data;
          payment.forEach(element => {
            let data = Object.assign(element, source);
            // console.log(data)
            this.students.push(data);
            this.loading = false
          });
          this.$Progress.finish();
          //   console.log(response.data);
        })
        .catch(err => {
            this.loading = false
          Toast.fire({
            type: "error",
            title: "Error trying to fetch students"
          });
        });
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    search() {
      this.$Progress.start();
      axios
        .get("/search/" + this.classroom)
        .then(response => {
          this.sections = response.data;
          this.$Progress.finish();
        })
        .catch(err => {
          Toast.fire({
            type: "error",
            title: "Contact Admin"
          });
          console.log(err);
          this.$Progress.fail();
        });
    },
    fecthbill() {
      this.$Progress.start();
      axios
        .get("/fetchbill", {
          params: { classroom: this.classroom }
        })
        .then(response => {
          this.payment = response.data;
          this.$Progress.finish();
          this.search();
        })
        .catch(err => {});
    },
    clearbill() {
      this.classroom = "";
      this.payment = "";
      this.section = "";
    },
    assign(item) {
      if (item == "all") {
        // alert('all')
        this.students.forEach(element => {
          element.assign = 1;
        });
      } else {
        item.assign = 1;
      }
    },
    unassign(item) {
      if (item == "all") {
        this.students.forEach(element => {
          element.assign = 0;
        });
      } else {
        item.assign = 0;
      }
    },
    saveassign(){
        a
    }
  },
  created() {
    this.$store.dispatch("loadclassrooms");
  },
  beforeUpdate() {
    this.totalRows = this.students.length;
    //   this.currentPage = 1
  }
};
</script>

<style>
</style>

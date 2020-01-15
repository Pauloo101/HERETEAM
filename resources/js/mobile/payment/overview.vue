<template>
  <b-tabs content-class="mt-3" fill>
    <b-tab title="Payment Overview" active>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- <div class="card-header"></div> -->
            <div class>
              <div class="row">
                <div class="col-3">
                  <div class="formgroup pl-2">
                    <label>Select Class</label>
                    <select
                      class="form-control form-control-sm"
                      v-model="classroom"
                      @change="fetchbill"
                    >
                      <optgroup label="pick a class">
                        <option v-for="c in classrooms" :key="c.id" :value="c.id">{{c.name}}</option>
                      </optgroup>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <b-container fluid>
            <!-- User Interface controls -->
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

            <!-- Main table element -->
            <b-table
              :busy="isBusy"
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
                <b-button
                  v-if="row.item.approve == 0"
                  class="btn btn-danger btn-sm"
                  @click="select(row.item)"
                >
                  <i class="fas fa-times"></i>
                </b-button>
                <b-button class="btn btn-sm btn-success" v-else @click="select(row.item)">
                  <i class="fas fa-check-square"></i>
                </b-button>
              </template>

              <template v-slot:row-details="row">
                <!--  <b-card>
          <ul>
             <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
           </ul>
                </b-card>-->
              </template>
            </b-table>

            <!-- Info modal -->
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
          </b-container>
        </div>
      </div>
    </b-tab>
    <b-tab title="History Overview">
      <history></history>
    </b-tab>

  </b-tabs>
</template>

<script>
export default {
  data() {
    return {
      students: [],
      header: "",
      body: "",
      classroom: "",
      isBusy: false,
      fields: [
        {
          key: "surname",
          label: "Surname",
          sortable: true,
          class: "text-center"
        },
        {
          key: "first_name",
          label: "First Name",
          sortable: true,
          class: "text-center"
        }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [2, 5, 10, 15, 20],
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: []
    };
  },
  methods: {
    fetchbill() {
      this.isBusy = true;
      this.students = [];
      this.fields = [
        {
          key: "surname",
          label: "Surname",
          sortable: true,
          class: "text-center"
        },
        {
          key: "first_name",
          label: "First Name",
          sortable: true,
          class: "text-center"
        }
      ];

      this.$Progress.start();
      let header = axios.get("/fetchbill/", {
        params: { classroom: this.classroom }
      });
      let body = axios.get("/paymentoverview", {
        params: { classroom: this.classroom }
      });
      axios
        .all([header, body])
        .then(
          axios.spread((...responses) => {
            // alert("here");
            this.header = responses[0].data;
            this.body = responses[1].data;
            //for header
            let fields = [];
            for (let i = 0; i < this.header.length; i++) {
              let options = {
                sortable: true,
                class: "text-center"
              };
              options.key = `${this.header[i].id}`;
              options.label = this.header[i].name;
              this.fields.push(options);
            }
            //end of header
            // console.log(this.body);
            let matric = [];
            let students = [];
            //for body
            for (let x = 0; x < this.body.length; x++) {
              let student = {};
              if (matric.includes(this.body[x].matric_no)) {
                let obj = students.find((o, i) => {
                  if (o.matric_no == this.body[x].matric_no) {
                    o[`${this.body[x].id}`] = this.body[x].total;
                    students[i] = o;
                  }
                });
                // student[`${this.body[x].id}`] = this.body[x].total;
              } else {
                matric.push(this.body[x].matric_no);
                student.first_name = this.body[x].first_name;
                student.surname = this.body[x].surname;
                student.matric_no = this.body[x].matric_no;
                student[`${this.body[x].id}`] = this.body[x].total;
                students.push(student);
              }
            }
            //end body
            // this.fields =
            // end of header
            // console.log(students);
            this.students = students;
            this.$Progress.finish();
            this.isBusy = false;
            Fire.$emit("billdetails", this.header);
          })
        )
        .catch(err => {
          this.$Progress.fail();
          console.error(err);
        });
    },
    paymentoverview() {
      this.$Progress.start();
      axios
        .get("/paymentoverview", {
          params: { classroom: this.classroom }
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(err => {
          console.log(err);
        });
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  },
  computed: {
    // fields() {
    // let header = this.header
    // let options =  {
    //   key: "matric_no",
    //   label: "Matric number",
    //   sortable: true,
    //   class: "text-center"
    // }
    // let fields = []
    // header.forEach(element => {
    //     options.key = element.name
    //     options.label = element.name
    //     fields.push(options)
    // });
    // let fields = [
    // {
    //   key: "matric_no",
    //   label: "Matric number",
    //   sortable: true,
    //   class: "text-center"
    // },
    // { key: "actions", label: "Approve" }
    //   ]
    // return fields;
    // },
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

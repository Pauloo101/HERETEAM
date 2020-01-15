<template>
  <div>
    <div class="row">
      <div class="col">
        <div class="card">

          <div class="card-body p-1">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Select Bill</label>
                  <select
                    class="form-control form-control-sm"
                    v-model="payment_name"
                    @change="gethistory(0)"
                  >
                    <option v-for="(p, index) in payments" :key="index">{{p}}</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Select class</label>
                  <select class="form-control form-control-sm" v-model="classroom">
                    <option v-for="c in classrooms" :key="c.id" :value="c.id">{{c.name}}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
    <div class="row">
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
              <b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select>
            </b-form-group>
          </b-col>
        </b-row>

        <b-table
          head-variant="dark"
          :busy="loading"
          show-empty
          small
          stacked="md"
          :items="history"
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
          <template
            v-slot:cell(detail)="row"
          >{{ row.value.first_name }} {{ row.value.surname }} {{row.value.other_name}}</template>

          <template v-slot:cell(actions)="row">
            <!-- <b-button
              size="sm"
              @click="info(row.item, row.index, $event.target)"
              class="mr-1"
            >Info modal</b-button>-->
            <b-button
              size="sm"
              @click="row.toggleDetails" @mousedown="gettotal(row)"
            >{{ row.detailsShowing ? 'Hide' : 'Show' }} Details</b-button>
          </template>

          <template v-slot:row-details="row">
            <b-card>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Amount</th>
                      <th>Reference</th>
                      <th>Method(bank)</th>
                      <th>Date paid</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(value, key) in row.item.history" :key="key">
                      <td>{{value.hamount}}</td>
                      <td>{{value.hreference_no}}</td>
                      <td>{{value.hdescription}}</td>
                      <td>{{value.hdate_paid}}</td>
                    </tr>
                  </tbody>
                </table>

                <span class="bg-info">
                  Total = {{total[row.index]}}
                </span>
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
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
    total:[],
      items: [
        {
          isActive: true,
          age: 40,
          name: { first: "Dickerson", last: "Macdonald" }
        },
        { isActive: false, age: 21, name: { first: "Larsen", last: "Shaw" } }
      ],
      fields: [
        {
          key: "matric_no",
          label: "Matric",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "detail",
          label: "Full Name",
          sortable: true,
          class: "text-center"
        },
        {
          key: "classroom",
          label: "Classroom",
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
      filterOn: [],

      usage: [],
      requestname: "",
      payments: "",
      payment_name: "",
      history: [],
      classroom: ""
    };
  },
  methods: {
    gethistory(name) {
        this.loading = true;
      axios
        .get("gethistory", {
          params: {
            name: name,
            payment_name: this.payment_name
          }
        })
        .then(response => {

          if (name == 1) {
            this.payments = response.data.names;
          } else {
            this.history = [];
            let w = [];
            let h = 0;
            let students = [];
            let history = response.data.history;
            //   this.history  = response.data.history
            for (let index = 0; index < history.length; index++) {
              let element = history[index];
              let student = {};
              if (w.find(e => e == element.matric_no)) {
                w.push(element.matric_no);

                let count = _.countBy(w);
                let v = "q" + count[element.matric_no];

                let p = {
                  hamount: element.hamount,
                  hreference_no: element.hreference_no,
                  hdescription: element.hdescription,
                  hdate_paid: element.hdate_paid
                };
                //edit
                _.findIndex(students, function(o, i) {
                  if (o.matric_no == element.matric_no) {
                    o["history"].push(p);
                  }
                });
              } else {
                w.push(element.matric_no);
                student.detail = {
                  id: element.student_id,
                  first_name: element.first_name,
                  surname: element.surname,
                  other_name: element.other_name
                };

                student.q = {
                  hamount: element.hamount,
                  hreference_no: element.hreference_no,
                  hdescription: element.hdescription,
                  hdate_paid: element.hdate_paid
                };
                student.history = [student.q];

                students.push({
                  id: element.student_id,
                  matric_no: element.matric_no,
                  classroom: element.classroom,
                  detail: student.detail,
                  history: student.history
                });
              }
            }
            this.history = students;
          }
          this.loading = false;
        })
        .catch(err => {
          console.log(err);
          Toast.fire({
            type: "error",
            title: "Error fetching payments"
          });
        });
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    fixdata() {
      if (this.loading) {
        this.loading = false;
      } else {
        this.loading = true;
      }
    },
    gettotal(item){
        let value = 0
        item.item.history.forEach(element => {
            value = element.hamount+value
        });
        this.total[item.index] = value
    }
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
  beforeUpdate() {
    this.totalRows = this.history.length;
    //   this.currentPage = 1
  },

  created() {
    this.gethistory(1);
  }
};
</script>

<style>
</style>

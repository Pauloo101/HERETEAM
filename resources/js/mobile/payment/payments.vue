<template>
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          Create Bill
          <div class="card-tools">
            <i
              class="fas fa-question-circle text-info"
              v-b-tooltip.hover
              title="Create a payment carefully filling the fields"
            ></i>
          </div>
        </div>
        <div class="card-body">
          <createpayment></createpayment>
        </div>
      </div>
      <div class="mt-3">
        <div class="card">
          <div class="card-header">Payment History</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Refrence No / Teller no</th>
                    <th>Amount</th>
                    <th>Method</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="h in history" :key="h.id">
                    <td>{{h.reference_no}}</td>
                    <td>{{h.amount}}</td>
                    <td>{{h.description}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9 bg-light">
      <div class="container">
        <div class="row mt-3">
          <div class>
            <label>Select Student</label>
          </div>
          <div class="col">
            <v-select
              label="id"
              :filterable="false"
              v-model="student"
              @search="searchstudent"
              @input="getsettingpayment"
              :options="students"
              :reduce="students => students.id"
            >
              <template slot="no-options">Enter the Student's name or matric Number</template>
              <template slot="option" slot-scope="option">
                <div class="text-center">{{option.first_name}} {{option.surname}}</div>
              </template>
              <template slot="selected-option" slot-scope="option">
                <div class="text-center">{{option.first_name}} {{option.surname}}</div>
              </template>
            </v-select>
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
        <b-table
          :busy="isBusy"
          striped
          hover
          show-empty
          small
          stacked="md"
          :items="payments"
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
          <template
            v-slot:cell(status)="row"
          >{{ row.item.status != 0 ? 'Fully Paid' : 'Incomplete Payment' }}</template>
          <template v-slot:cell(actions)="row">
            <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
                         Info modal
            </b-button>-->
            <b-button size="sm" @click="fetchhistory(row.item)">View History</b-button>
            <b-button
              size="sm"
              @click="row.toggleDetails"
            >{{ row.detailsShowing ? 'Cancel' : 'Enter payment' }}</b-button>
          </template>

          <template v-slot:row-details="row">
            <!-- <P>{{row.item.status}}</P> -->
            <b-card>
                <ValidationObserver v-slot="{invalid}">
              <div class="row">
                <div class="col">
                  <label>Enter Amount Paid</label>
                  <ValidationProvider rules="positive|min:3|required" v-slot="{errors}">
                    <input
                      class="form-control form-control-sm"
                      placeholder="Amouunt"
                      v-model="amount[row.item.id]"
                      type="number"
                    />
                    <span class="text-danger
                    ">{{errors[0]}}</span>
                  </ValidationProvider>
                </div>
                <div class="col">
                  <label>Enter Reference no / Teller No</label>
                  <ValidationProvider rules="positive|min:3|required" v-slot="{errors}">
                    <input name="Reference"
                      class="form-control form-control-sm"
                      placeholder="Enter reference number or Teller no"
                      v-model="reference_no[row.item.id]"
                      type="text"
                    />
                    <span class="text-danger">{{ errors[0] }}</span>
                  </ValidationProvider>
                </div>
                <div class="col">
                  <label>Method</label>
                  <ValidationProvider rules="min:3|required" v-slot="{errors}">
                    <input
                      class="form-control form-control-sm"
                      placeholder="either teller or bank transfer"
                      v-model="description[row.item.id]"
                      type="text"
                    />
                    <span class="text-danger
                    ">{{ errors[0] }}</span>
                  </ValidationProvider>
                </div>
                <div class="col">
                  <!-- validation -->
                  <label>Date paid</label>
                  <input
                    type="date"
                    class="form-control form-control-sm"
                    v-model="date_paid[row.item.id]"
                  />
                  <p>{{date_paid[row.item.id]}}</p>
                </div>
              </div>
              <!-- <p>{{payments}}</p> -->

              <div class="row mt-3">
                <div class="col text-right">
                  <button class="btn btn-outline-success" @click="recordpayment(row.item)" :disabled="invalid">Save</button>
                </div>
              </div>
              </ValidationObserver>
            </b-card>
          </template>
           <template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
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

      <div class="mt-3">
        <lists></lists>
      </div>
    </div>
  </div>
</template>

<script>
import createpayment from "./createpayment";
import lists from "./list";
export default {
  components: { createpayment, lists },

  data() {
    return {
        isBusy:false,
        test:'',
      date_paid: [],
      students: [],
      student: "",
      payments: [],
      history: "",
      amount: [],
      description: [],
      reference_no: [],
      fields: [
        {
          key: "name",
          label: "Bill",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "amount",
          label: "Amount",
          sortable: true,
          class: "text-center"
        },
        {
          key: "description",
          label: "Details",
          sortable: true,
          class: "text-center"
        },
        {
          key: "status",
          label: "Status",
          sortable: true,
          class: "text-center"
        },
        {
          key: "total",
          label: "Amount Paid",
          class: "text-center"
        },
        {
          key: "pending",
          label: "Balance",
          class: "text-center"
        },
        { key: "actions", label: "Actions" }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: "5",
      pageOptions: [5, 10, 15, 20],
      sortBy: "",
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
  methods: {
    recordpayment(item) {
      let id = item.id;
      axios
        .post("/recordpayment", {
          payment: id,
          amount: this.amount[id],
          reference_no: this.reference_no[id],
          description: this.description[id],
          student: this.student,
          date_paid: this.date_paid[id]
        })
        .then(() => {
          this.$bvToast.toast("Record(s) saved!", {
            title: "Success",
            variant: "success",
            solid: true
          });
        })
        .catch(e => {
          console.log(e);
        });
    },

    fetchhistory(item) {

      axios
        .get("/fetchhistory", {
          params: {
            payment: item.id,
            student: this.student
          }
        })
        .then((response)=>{
            this.history = response.data
            t
        })
        .catch(e => {
          console.log(e);
        });
    },
    savepayment() {
      axios.post("/savepayment", {
        amount: this.amount,
        student: this.student
      });
    },
    searchstudent(search, loading) {
      loading(true);
      axios
        .get("/searchstudent", {
          params: {
            search: search
          }
        })
        .then(response => {
          this.students = response.data;
          loading(false);
        })
        .catch(e => {
          console.log(e);
        });
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
      this.newquantity = "";
      this.newprice = "";
    },
    getsettingpayment() {
        this.isBusy = true
      axios
        .get("/getsettingpayment", {
          params: {
            student: this.student
          }
        })
        .then((response)=>{
            this.payments = response.data
            this.isBusy = false
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  computed: {
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
    this.totalRows = this.payments.length;
  }
};
</script>

<style>
</style>

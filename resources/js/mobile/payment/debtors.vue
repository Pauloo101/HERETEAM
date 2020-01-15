<template>
  <div>
    <div class="bg-info mt-2 mb-3 p-2">
      <div class="row">
        <div class="col">
          <div class="row no-gutters">
            <div class="col-4">
              <label>Select class</label>
            </div>
            <div class="col">
              <select class="form-control form-control-sm" v-model="classroom" @change="search">
                <optgroup label="select a class">
                  <!-- <option value="0">all</option> -->
                  <option
                    v-for="classroom in classrooms"
                    :key="classroom.id"
                    :value="classroom.id"
                  >{{classroom.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="row no-gutters">
            <div class="col-4">
              <label>Select section</label>
            </div>
            <div class="col">
              <select class="form-control form-control-sm" v-model="section" @change="fetchbill">
                <optgroup label="select a section">
                  <option value="0">all</option>
                  <option
                    v-for="section in sections "
                    :key="section.id"
                    :value="section.id"
                  >{{section.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="row no-gutters">
            <div class="col">
              <label>Select payment</label>
            </div>
            <div class="col">
              <select class="form-control form-control-sm" v-model="payment" @change="fetchdebtors">
                <optgroup label="select a section">
                  <!-- <option value="0">all</option> -->
                  <option v-for="b in bills " :key="b.id" :value="b.id">{{b.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <label class="text-danger">Total debtors are {{counter }} in number</label> -->
    <div class="row">
      <div class="col">

           <b-container fluid>
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

      <b-col sm="5" md="3" class="my-1">
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
      <b-col md="3">
           <b-form-group
          label="Filter On"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          description="Leave all unchecked to filter on all data"
          class="mb-0">
          <b-form-checkbox-group v-model="filterOn" class="mt-1">
            <b-form-checkbox value="first_name">First Name</b-form-checkbox>
            <b-form-checkbox value="section">Section</b-form-checkbox>
            <!-- <b-form-checkbox value="isActive">Active</b-form-checkbox> -->
          </b-form-checkbox-group>
        </b-form-group>
      </b-col>
     </b-row>

     <b-table :busy="isBusy" outlined
      show-empty
      small
      stacked="md"
      :items="debtors"
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
  </b-container>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isBusy: false,
      classroom: "",
      sections: "",
      section: "",
      payments: "",
      payment: "",
      debtors: [],
      bills: "",
      fields: [
        {
          key: "matric_no",
          label: "Matric NO",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "surname",
          label: "Surname",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "first_name",
          label: "First Name",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "section",
          label: "Section",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "amount",
          label: "Amount",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "pending",
          label: "Pending",
          sortable: true,
          sortDirection: "desc"
        },
        { key: "total", label: "Paid", sortable: true, sortDirection: "desc" }
      ],

      totalRows: 0,
      currentPage: 1,
      perPage: "5",
      pageOptions: [5, 10, 15, 20],
      sortBy: '',
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: [],
    };
  },
  created() {
    this.$store.dispatch("loadclassrooms");
  },
  computed: {
    //   counter(){
    //       let value = this.debtors.length
    //       this.totalRows = this.debtors.length
    //       this.currentPage = 1
    //       return value
    //   },
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
    classrooms() {
      return this.$store.state.classrooms;
    },
  },

  methods: {

    search() {
        this.section = ''
      this.bills = ''
      axios
        .get("/search/" + this.classroom)
        .then(response => {
          this.sections = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchdebtors() {
        this.$Progress.start()
        this.isBusy = true
      axios
        .get("/fetchdebtors", {
          params: {
            classroom: this.classroom,
            section: this.section,
            payment: this.payment
          }
        })
        .then((response)=>{
            this.debtors = response.data
            this.isBusy = false
            this.$Progress.finish()
        })
        .catch((e) => {
            this.$Progress.fail()
            this.isBusy = false
          console.log(e);
        });
    },
    fetchbill() {
      axios
        .get("/fetchbill", {
          params: {
            classroom: this.classroom,
            section: this.section
          }
        })
        .then(({ data }) => this.bills = data)
        .catch(() => {
          console.log(e);
        });
    },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      }
  },
//    mounted() {
//       this.totalRows = this.debtors.length
//       this.currentPage = 1

//     },
    beforeUpdate() {
         this.totalRows = this.debtors.length
    //   this.currentPage = 1
    },


};
</script>

<style>
</style>

<template>
 <div class="card">
      <div class="card-header">
          <label>Transactions</label>
          <div class="card-tools">
              <button class="btn btn-sm btn-success" @click="confirm">Confirm a transaction</button>
          </div>
      </div>
      <div class="card-body">
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

     <b-table :busy="isBusy" outlined
      show-empty
      :tbody-tr-class="rowClass"
      small
      stacked="md"
      :items="transactions"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
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
           <div role="group" class="btn-group">
                         <b-button
                            variant="outline-info"
                            v-b-tooltip.hover
                            title="View Student"
                            class="btn btn-sm"
                            @click="stud(row.item)"
                            >
                            <i class="far fa-eye"></i>
                         </b-button>
                    <button class="btn btn-danger btn-sm" v-b-tooltip.hover title="Delete">
                         <i class="fas fa-trash"></i>
                    </button>
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
</template>

<script>
export default {
    data() {
        return {
          transactions:[],
           isBusy: false,
           fields:[
                {
                    key:"code",
                    label:"ID",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"type",
                    label:"Type",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"parent_id",
                    label:"P_id",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"amount",
                    label:"amount",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"status",
                    label:"status",
                    sortable:true,
                    sortDirection:"desc"
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
        }
    },
    created() {
        axios.get('/gettransactions')
            .then(response  =>{
                this.transactions = response.data
            })
    },
    computed: {
          sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
    },
    methods: {
         onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
       rowClass(item, type) {
        if (!item) return
        if (item.status === 0) return 'table-danger'
        if (item.status === 1) return 'table-success'
      },
      confirm(){
          let here = 'T966945904368789'
          axios.get('/payverify')
          .then(response =>{
              console.log(response)
          })
           .catch((e)=>{
              console.log(e)
          })

      },
    },
     beforeUpdate() {
         this.totalRows = this.transactions.length
    //   this.currentPage = 1  T966945904368789
    },
}
</script>

<style>

</style>

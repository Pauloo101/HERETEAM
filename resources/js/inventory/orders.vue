<template>
  <div>
    <div class="card">
      <div class="card-header">
        Orders
        <div class="card-tools">
          <i class="fas fa-shopping-cart text-primary" style="font-size: 20px"></i>
          <span class="badge badge-danger navbar-badge">{{count}}</span>
        </div>
      </div>
      <div class="card-body p-0">
          <!-- <b-container fluid> -->
               <b-row >
                    <b-col cols="4">
           <b-form-group
          label="Per page"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          label-for="perPageSelect"
          class=""
        >
          <b-form-select
            v-model="perPage"
            id="perPageSelect"
            size="sm"
            :options="pageOptions"
          ></b-form-select>
        </b-form-group>
      </b-col>
      <b-col  cols="8">
        <b-form-group
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

     </b-row>

     <b-table :busy="isBusy" outlined
     :tbody-tr-class="rowClass"
      show-empty
      stacked="md"
      :items="orders"
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
                    <b-button size="sm" @click="row.toggleDetails" v-b-tooltip.hover title="Show order details">
                        {{ row.detailsShowing ? 'Hide' : 'Show' }}
                    </b-button>
                    <button v-if="row.item.status == 0" class="btn btn-success btn-sm" v-b-tooltip.hover title="Process Order">
                        <i class="fas fa-cogs"></i>
                    </button>
                    </div>
          </template>
          <template slot="row-details" slot-scope="row">
                    <b-card>
                        <ul>
                            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                        </ul>
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
  <!-- </b-container> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            isBusy:false,
            count:'',
            orders:[],
            fields:[
                {
                    key:"customer_id",
                    label:"Customer",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"order_code",
                    label:"Order Code",
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
        axios.get('/getorders')
        .then(response =>{
            this.orders = response.data.order
            this.count = response.data.count
            // console.log(response)
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
        if (item.status === 0){
          return 'table-danger'
        }
        else if((item.status === 1) && (item.collected === 1))
        {
            return 'table-success'
        } else if ((item.status === 1)&&(item.collected === 0))
        {
            return 'table-warning'
        }
      }
    },
     beforeUpdate() {
         this.totalRows = this.orders.length
    //   this.currentPage = 1
    },

};
</script>

<style>
</style>

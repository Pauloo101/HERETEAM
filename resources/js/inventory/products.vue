<template>
  <div class="card">
      <div class="card-header">
          <label>Products</label>
          <div class="card-tools">
              <button class="btn btn-sm btn-success">New Product</button>
          </div>
      </div>
      <div class="card-body">
           <!-- <b-container fluid> -->
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
      small
      stacked="md"
      :items="products"
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
  <!-- </b-container> -->
      </div>
<!--
        <select v-model="product" class="form-control form-control-sm">
            <option v-for="p in products" :key="p.id" :value="p.product">{{p.product}}</option>
        </select>
        <input v-model="quantity"/>

        <input v-model="id">
        <input v-model="date_placed">
        <input v-model="total">
        <input v-model="details">
        <p>{{product}}</p>
        <p>{{cart}}</p>
        <button @click="add">here</button>
         -->
<!-- <input v-model="code">
<button @click="placeorder">kk</button> -->
  </div>
</template>

<script>
export default {
    data() {
        return {
          products:[],
          product:'',
          quantity:'',
          code:'',
          id:'',
          date_placed:'',
          total:'',
          details:'',
           isBusy: false,
           fields:[
                {
                    key:"product",
                    label:"Name",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"quantity",
                    label:"Quantity",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"price",
                    label:"Price",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"category",
                    label:" Category ",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"description",
                    label:"description",
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
    //   cart:[],
        }
    },
    created() {
        axios.get('/getproducts')
            .then(response  =>{
                this.products = response.data
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
        placeorder(){
            axios.post('placeorder',{cart:this.cart,
            order_code:this.code,id:this.id,date_placed:this.date_placed,total:this.total,details:this.details})
            .then(response =>{
                console.log(response)
            })
            .catch((e)=>{
                console.log(e)
            })
        },
        add(){
            this.cart.push({
                'product':this.product,
                'quantity':this.quantity
            })
        },
         onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      }
    },
     beforeUpdate() {
         this.totalRows = this.products.length
    //   this.currentPage = 1
    },
}
</script>

<style>

</style>

<template>
   <div class="row">
       <div class="col">
        <b-container fluid>
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
            <!--<p>{{infoModal.content}}</p>-->
            <b-table
                    show-empty
                    stacked="md"
                    :items="students"
                    :fields="fields"
                    :current-page="currentPage"
                    :per-page="perPage"
                    :filter="filter"
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"
                    :sort-direction="sortDirection"
                    @filtered="onFiltered"
            >

                <template slot="actions" slot-scope="row">
                    <b-button size="sm" variant="outline-success" @click="info(row.item, row.index, $event.target)" class="mr-1">
                        Edit
                    </b-button>
                    <b-button size="sm" variant="outline-danger" @click="deleteproduct(row.item, row.index, $event.target)" class="mr-1">
                        Delete
                    </b-button>
                    <b-button size="sm" @click="row.toggleDetails">
                        {{ row.detailsShowing ? 'Hide' : 'Show' }}
                    </b-button>
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

            <!-- Info modal -->
            <b-modal :id="infoModal.id" :title="infoModal.content.name" ok-title="Update" @ok="updateproduct" @hide="resetInfoModal">
                <div>

                    <label>Current Stock Value is :</label> <label>{{infoModal.content.quantity}}</label>
                    <i class="far fa-question-circle text-info"
                       v-b-popover.hover="'The new Quantity would be added to the current Quantity.   And if you wish to change the price the current would be replace with the new one '"
                       title="Take Note" placement="right"></i>
                    <input class="form-control form-control-sm" type="number" v-model="newquantity" placeholder="enter the new Quantity"/>
                </div>
                <div>
                    <label>Current Price is :</label> <label>{{infoModal.content.price}}</label>
                    <input class="form-control form-control-sm" type="number" v-model="newprice" placeholder="enter the new price"/>
                </div>
            </b-modal>
            <!--delete modal-->
            <b-modal :id="deleteModal.id" :title="deleteModal.content.name" ok-title="Delete" ok-variant="danger" @ok="confirmdelete(deleteModal.content.id)" @hide="resetdeleteModal">
                <div>
                    <h1>Are You Sure ?</h1>
                    <i class="far fa-question-circle text-danger"
                       v-b-popover.hover="' Product Records will be removed '"
                       title="Take Note" placement="right"></i>
                </div>
            </b-modal>
        </b-container>

       </div>
       <div class="col-4">
           <ul class="list-group">
            <li class="list-group-item">
                <div>
                    <span class="float-left m-auto">Subject</span>
                    <span class="float-right">(section)</span>
                    <span class="float-right">Classroom</span>
                </div>
            </li>
            <li class="list-group-item"><span>List Group Item 2</span></li>
            <li class="list-group-item"><span>List Group Item 3</span></li>
        </ul>
       </div>
   </div>
</template>

<script>
export default {
    data(){
        return{
            subjects:'',
            students:'',

            fields: [
                    { key: 'name', label: 'Product Name', sortable: true, sortDirection: 'desc' },
                    { key: 'price', label: 'Price', sortable: true, class: 'text-center' },
                    { key: 'quantity', label: 'Quantity', class: 'text-center'},
                    { key: 'category', label: 'Category', sortable: true, },
                    { key: 'actions', label: 'Actions' }
                ],

            totalRows: 1,
                currentPage: 1,
                perPage: '5',
                pageOptions: [5, 10, 15, 20],
                sortBy: null,
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                infoModal: {
                    id: 'info-modal',
                    title: '',
                    content: ''
                },
                deleteModal: {
                    id: 'delete-modal',
                    title: '',
                    content: ''
                }
        }
    },
    created() {
        axios.get('/teachers/teacher-subject')
        .then(({data}) => this.subjects = data)
        .catch((e)=>{
            console.log(e)
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
            }
    },
    methods: {
         info(item, index, button) {
                this.infoModal.title = `Row index: ${index}`
                this.infoModal.content = item
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
                this.newquantity = ''
                this.newprice = ''
            },
            resetdeleteModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
    },

}
</script>

<style>

</style>

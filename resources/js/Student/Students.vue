<template>
<div>

  <div class="col-md-12">
    <div class="card-body p-1 ">
      <!-- <div class="card-header">Student Overview</div> -->
      <div class="row no-gutters">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">
                    Search filter
                    <div class="card-tools">
                        <span class="badge-danger">{{students.length}}</span>
                    </div>
                </div>
                <div class="card-body">
          <div class="form-group">
            <label>Select Class</label>
            <select class="form-control form-control-sm" @change="search"  v-model="classroom">
              <optgroup label="This is a group">
                <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id">{{classroom.name}}</option>
              </optgroup>
            </select>
          </div>
          <div class="form-group">
            <label >Select Section</label>
            <select class="form-control form-control-sm" v-model="section" @change="fetchstudent">
              <optgroup label="This is a group">
                <option v-for="section in sections" :key="section.id" :value="section.id">{{section.name}}</option>
              </optgroup>
            </select>
          </div>
          <button class="btn btn-outline-primary" @click="clearfilter">Clear</button>
          </div>
        </div>
        </div>

        <div class="col-md-10">
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
      small
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
                    <button class="btn btn-danger btn-sm" v-b-tooltip.hover title="Delete" @click="deletestud(row.item)">
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
    </div>
  </div>

</div>
</template>
<script>
import { studentevent } from '../app'
export default {
  name : "Students",
    data(){
        return{
             isBusy: false,
            classroom:'',
            sections:'',
            section:'',
            students:[],
            fields:[
                {
                    key:"matric_no",
                    label:"Matric No",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"first_name",
                    label:"First Name",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"surname",
                    label:"surname",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"gender",
                    label:"Gender",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"classroom",
                    label:"Class",
                    sortable:true,
                    sortDirection:"desc"
                },
                {
                    key:"name",
                    label:"Section",
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
    created(){
        this.$store.dispatch("loadclassrooms")
    },
    computed:{
        classrooms(){
            return this.$store.state.classrooms
        },
        sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
    },
    methods:{
        clearfilter(){
            this.classroom ='',
            this.section =''
        },
        stud(student){
            // console.log(student)
            studentevent.$emit('student', student)
        },
        deletestud(student){
        Swal.fire({
      title: "Delete the student ",
      text:
        " Are you sure? ",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "No"
    }).then(result => {
      if (result.value) {
       axios.post('/removestudent', student)
            .then((response) => {
                Toast.fire({
                    type:'success',
                    title:'Deleted'
                })
                this.fetchstudent();
            }).catch((err) => {

            });
      }
    });

        },
        search(){
            this.$Progress.start()
            axios
            .get("/search/" + this.classroom)
            .then((response)=>{
                this.sections = response.data
                this.fetchstudent()
                this.$Progress.finish()
            })
            .catch((e)=>{
                this.$Progress.fail()
                console.log(e)
            })
        },
        fetchstudent(){
            this.$Progress.start()
            this.isBusy = true
            axios.get("/fetchstudent",{
                params: {
                    classroom: this.classroom,
                    section : this.section,
                }
            })
            .then((response)=>{
                this.students = response.data
                this.isBusy = false
                this.$Progress.finish()

            })
            .catch((e)=>{
                this.$Progress.fail()
                this.isBusy = false
                console.log(e)
            })
        },
           onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      }
    },
      beforeUpdate() {
         this.totalRows = this.students.length
    //   this.currentPage = 1
    },

};
</script>

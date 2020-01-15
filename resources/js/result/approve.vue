<template>
  <div>
    <div class="row mt-3">
      <div class="col-3">
        <div class="card">
          <div class="card-header">
            Approve For
            <div class="card-tools">
              <button class="btn btn-sm btn-outline-info" @click="clearfilter">Clear</button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Select Classroom</label>
              <select class="form-control form-control-sm" @change="subjectresult" v-model="classroom">
                <optgroup label="select Classroom">
                  <option v-for="c in classrooms" :key="c.id" :value="c.id">{{c.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>
          <div class="card-footer">
              <button class="btn btn-sm btn-secondary" @click="approveall">Approve All</button>
          </div>

        </div>
      </div>
      <div class="col-9">
        <div class="card p-0">
          <div class="card-body p-0">
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
                    class="btn btn-danger  btn-sm"
                    @click="select(row.item)"

                  >
                    <i class="fas fa-times"></i>
                  </b-button>
                  <b-button class="btn btn-sm btn-success"   v-else @click="select(row.item)">
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
            </b-container>
          </div>
          <div class="card-footer">

              <button class="btn btn-sm btn-outline-success"  v-b-tooltip.hover
                    title="Approve result for selecteed students"  @click="approve" :disabled="btn">Save Approve</button>
              <!-- <button class="btn btn-sm btn-danger"  v-b-tooltip.hover
                    title="Disapprove unselected students" @click="approve" :disabled="unpprovelist.length > 0 ? false: true">Save Unpprove</button> -->

              <b-col sm="7" md="6" class="my-1 float-right">
                <b-pagination
                  v-model="currentPage"
                  :total-rows="totalRows"
                  :per-page="perPage"
                  align="fill"
                  size="sm"
                  class="my-0"
                ></b-pagination>
              </b-col>
          </div>
        </div>
    <!-- <p>{{selected}}</p>
    <p>{{unpprovelist}}</p> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subject: "",
      isBusy: false,
      classroom: "",
      section: "",
      sections: "",
      selected: [],
      students: [],
      student: "",

      fields: [
        {
          key: "matric_no",
          label: "Matric number",
          sortable: true,
          class: "text-center"
        },
        {
          key: "first_name",
          label: "First Name",
          sortable: true,
          class: "text-center",
          sortDirection: "desc"
        },
        {
          key: "surname",
          label: "Surname",
          sortable: true,
          class: "text-center"
        },
        { key: "actions", label: "Approve" }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15, 20],
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: []
    };
  },
  computed: {
      unpprovelist(){
          let list = [];
          this.students.forEach(element => {

              if (element.approve == 0) {

                  list.push(element.id)
              }
          });
          return list;
      },
    btn() {
      if ((this.selected.length == 0) && (this.unpprovelist.length == 0)) {
        return true;
      } else {
        return false;
      }
    },
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key };
        });
    },
    classrooms() {
      return this.$store.state.classrooms;
    },
    subjects() {
      return this.$store.state.subjects;
    }
  },
  mounted() {
    // Set the initial number of items
    // this.totalRows = this.items.length;
  },
  methods: {
      approve(){
      this.$Progress.start()
          axios.post("/approve",{students:this.selected, classroom:this.classroom , unapprove:this.unpprovelist})
          .then((response) => {
            //   console.log(response.data);
              Toast.fire({
                  type:'success',
                  title:response.data
              })
      this.$Progress.finish()

          }).catch((err) => {
             Toast.fire({
                  type:'error',
              title:'Network Error'
             })
          });
      },
      approveall(){
          let i =0
          let students = []
          this.students.forEach(element => {
            //   alert(element.id)
              this.students[i].approve = 1
              students.push(element.id)
              i++
          });
          var x = _.uniq(students)
          this.selected = []
          this.selected = x
      },
    select(item) {
      let id = item.id;
      if(item.approve == 1){
          let v = this.selected.includes(id);
          if(v == true){
              let index = this.selected.indexOf(id);
                this.selected.splice(index, 1);
          }
          item.approve = 0
      }else{
          item.approve = 1;
           this.selected.push(id);
      }
    //    let v = this.selected.includes(id);
    //    if (v == true) {
    //             let index = this.selected.indexOf(id);
    //             this.selected.splice(index, 1);
    //             item.approve = 0;
    //         } else {
    //             this.selected.push(id);
    //         }
      // console.log(item)

    },
    /**  search() {
    //   this.$Progress.start();
    //   axios
    //     .get("/search/" + this.classroom)
    //     .then(response => {
    //       this.sections = response.data;
    //       this.subjectresult();
    //       this.$Progress.finish();
    //     })
    //     .catch(err => {
    //       this.$Progress.fail();
    //       console.error(e);
    //     });
     },*/
    clearfilter() {
      (this.classroom = ""), (this.section = "");
    },
    fetchclass() {
      axios
        .get("/fetchclass/" + this.subject)
        .then(({ data }) => (this.sections = data));
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    subjectresult() {
      this.$Progress.start()
      axios
        .get("/subjectresult", {
          params: {
            subject: this.subject,
            classroom: this.classroom,
            section: this.section
          }
        })
        .then(response => {
          this.students = response.data;
      this.$Progress.finish()
        })
        .catch(err => {
          console.log(err);
      this.$Progress.fail()
        });
    }
  },
  created() {
      this.$Progress.start()
    this.$store.dispatch("loadclassrooms");
    this.$store.dispatch("loadsubjects");
      this.$Progress.finish()

  },
  beforeUpdate() {
    this.totalRows = this.students.length;
    //   this.currentPage = 1
  }
};
</script>

<style>
</style>

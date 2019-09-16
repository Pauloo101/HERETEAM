<template>
<div>

  <div class="col-md-12">
    <div class="card-body">
      <!-- <div class="card-header">Student Overview</div> -->
      <div class="row no-gutters">
        <div class="col-md-2">
            <div class="card">
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
            <select class="form-control form-control-sm" v-model="section">
              <optgroup label="This is a group">
                <option v-for="section in sections" :key="section.id" :value="section.id">{{section.name}}</option>
              </optgroup>
            </select>
          </div>
          <label>Or </label>
          <div class="form-group">
            <label >Enter a matric number</label>
           <input class="form-control form-control-sm">
          </div>
    <p>{{classroom}}{{section}}</p>
          <button class="btn btn-outline-primary" @click="fetchstudent">Fetch</button>
          </div>
        </div>
        </div>

        <div class="col-md-10">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Matric no </th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Gender</th>
                  <th>Class</th>
                  <th>Section</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in students" :key="student.id">
                  <td>{{student.matric_no}}</td>
                  <td>{{student.first_name}}</td>
                  <td>{{student.surname}}</td>
                  <td>{{student.gender}}</td>
                  <td>{{student.classroom}}</td>
                  <td>{{student.name}}</td>
                  <td>
                    <div role="group" class="btn-group">
                         <b-button
                            variant="outline-info"
                            v-b-tooltip.hover
                            title="View Student"
                            class="btn btn-sm"
                            @click="stud(student)"
                            >
                            <i class="far fa-eye"></i>
                         </b-button>
                    <button class="btn btn-danger btn-sm" v-b-tooltip.hover title="Delete">
                         <i class="fas fa-trash"></i>
                    </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
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
            classroom:'',
            sections:'',
            section:'',
            students:{}
        }

    },
    created(){
        this.$store.dispatch("loadclassrooms")
    },
    computed:{
        classrooms(){
            return this.$store.state.classrooms
        }
    },
    methods:{
        stud(student){
            studentevent.$emit('student', student)
        },
        search(){
            axios
            .get("/search/" + this.classroom)
            .then(({data}) => (this.sections = data));
        },
        fetchstudent(){
            axios.get("/fetchstudent",{
                params: {
                    classroom: this.classroom,
                    section : this.section,
                }
            })
            .then(({data}) => (this.students = data));
        }
    }

};
</script>

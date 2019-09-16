<template>
  <div>
    <form @submit.prevent="createstudent" @keydown="form.onKeydown($event)">
      <alert-error :form="form"></alert-error>
      <div class="card-header">Admission</div>
      <div class="card-body shadow-lg">
        <div class="form-row">
          <div class="col mb-3">
            <label class="d-flex">Matric Number</label>
            <input
              v-model="form.matric_no"
              name="matric_no"
              type="text"
              class="form-control-sm form-control"
              :class="{'is-invalid':form.errors.has('matric_no')}"
            >
            <has-error :form="form" field="matric_no"></has-error>
          </div>
          <div class="col mb-3">
            <label class="d-flex">Surname</label>
            <input
              v-model="form.surname"
              name="surname"
              type="text"
              class="form-control form-control-sm"
              :class="{'is-invalid':form.errors.has('surname')}"
            >
            <has-error :form="form" field="surname"></has-error>
          </div>
          <div class="col mb-3">
            <label class="d-flex">First Name</label>
            <input
              v-model="form.first_name"
              name="first_name"
              type="text"
              class="form-control form-control-sm"
              :class="{'is-invalid':form.errors.has('first_name')}"
            >
            <has-error :form="form" field="first_name"></has-error>
          </div>
          <div class="col mb-3">
            <label class="d-flex">Gender</label>
            <select
              v-model="form.gender"
              name="gender"
              class="form-control form-control-sm"
              :class="{'is-invalid':form.errors.has('gender')}"
            >
              <optgroup label="This is a group">
                <option value="M" selected>Male</option>
                <option value="F">Female</option>
              </optgroup>
            </select>
            <has-error :form="form" field="gender"></has-error>
          </div>
        </div>
        <div class="form-row">
          <div class="col mb-3">
            <label class="d-flex">Select Class</label>
            <select class="form-control form-control-sm"  :class="{'is-invalid':form.errors.has('classroom_id')}" name="classroom_id" @change="search" v-model="form.classroom_id">
                <optgroup label="This is a group">
                    <option v-for="classroom in classrooms" :value="classroom.id" :key="classroom.id" selected>{{classroom.name}}</option>
                </optgroup>
            </select>
            <has-error :form="form" field="classroom_id"></has-error>
          </div>
          <div class="col mb-3">
            <label class="d-flex">Select section</label>
            <select
              v-model="form.section_id"
              name="section_id"
              class="form-control form-control-sm"
              :class="{'is-invalid':form.errors.has('section_id')}"
            >
              <optgroup label="This is a group">
                <option v-for="temp in section" :key="temp.id" :value="temp.id" selected> {{temp.name}} </option>
              </optgroup>
            </select>
            <has-error :form="form" field="section_id"></has-error>
          </div>
          <div class="col mb-3">
            <label class="d-flex">Date of Birth</label>
            <input
              v-model="form.dob"
              name="dob"
              type="date"
              class="form-control form-control-sm"
              :class="{'is-invalid':form.errors.has('dob')}"
            >
            <has-error :form="form" field="dob"></has-error>
          </div>
          <div class="col mb-3">
            <label class="d-flex">Admission Date</label>
            <input type="date" class="form-control form-control-sm" disabled>
          </div>
        </div>
      </div>
      <div style="padding: 2px"></div>
      <div class="card">
        <div class="card-header">Parent Guardian Details</div>
        <div class="card-body shadow-lg">
          <div class="form-row">
            <div class="col mb-3">
              <label class="d-flex">Father's Name</label>
              <input
                v-model="form.father_name"
                name="father-name"
                type="text"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('father_name')}"
              >
              <has-error :form="form" field="father_name"></has-error>
            </div>
            <div class="col mb-3">
              <label class="d-flex">Father's Phone</label>
              <input
                v-model="form.father_phone"
                name="father_phone"
                type="number"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('father_name')}"
              >
              <has-error :form="form" field="father_name"></has-error>
            </div>
            <div class="col mb-3">
              <label class="d-flex">Father's Occupation</label>
              <input
                v-model="form.father_occupation"
                name="father_occupation"
                type="text"
                class="form-control form-control-sm"
              >
            </div>
            <div class="col mb-3">
              <label class="d-flex">Father's Email</label>
              <input
                v-model="form.father_email"
                name="father_email"
                type="email"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('father_email')}"
              >
              <has-error :form="form" field="father_email"></has-error>
            </div>
          </div>
          <div class="form-row">
            <div class="col mb-3">
              <label class="d-flex">Mother's Name</label>
              <input
                v-model="form.mother_name"
                name="mother_name"
                type="text"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('mother_name')}"
              >
              <has-error :form="form" field="mother_name"></has-error>
            </div>
            <div class="col mb-3">
              <label class="d-flex">Mother's Phone</label>
              <input
                v-model="form.mother_phone"
                type="number"
                name="mother_phone"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('mother_phone')}"
              >
              <has-error :form="form" field="mother_phone"></has-error>
            </div>
            <div class="col mb-3">
              <label class="d-flex">Mother's Occupation</label>
              <input
                v-model="form.mother_occupation"
                name="mother_occupation"
                type="text"
                class="form-control form-control-sm"
              >
            </div>
            <div class="col mb-3">
              <label class="d-flex">Mother's Email</label>
              <input
                v-model="form.mother_email"
                name="mother_email"
                type="email"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('mother_email')}"
              >
              <has-error :form="form" field="mother_email"></has-error>
            </div>
          </div>

          <div>
            <b-form-group label="If Guardian is  " class="d-inline">
              <b-form-radio name="guardian" @change="bindtofather" class="d-inline-flex">Father</b-form-radio>
              <b-form-radio name="guardian" @change="bindtomother" class="d-inline-flex">Mother</b-form-radio>
              <b-form-radio name="guardian" @change="bindtoother" class="d-inline-flex">Other</b-form-radio>
            </b-form-group>
          </div>
          <div class="form-row">
            <div class="col mb-3">
              <label class="d-flex">Guardian's Name</label>
              <input
                v-model="form.guardian_name"
                type="text"
                name="guardian_name"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('guardian_name')}"
              >
              <has-error :form="form" field="guardian_name"></has-error>
            </div>
            <div class="col mb-3">
              <label class="d-flex">Guardian's Phone</label>
              <input
                v-model="form.guardian_phone"
                type="number"
                name="guardian_phone"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('guardian_phone')}"
              >
              <has-error :form="form" field="guardian_phone"></has-error>
            </div>
            <div class="col mb-3">
              <label class="d-flex">Guardian's Relationship</label>
              <input
                v-model="form.relationship"
                name="relationship"
                type="text"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('relationship')}"
              >
              <has-error :form="form" field="relationship"></has-error>
            </div>
            <div class="col mb-3">
              <label class="d-flex">Guardian's Email</label>
              <input
                v-model="form.guardian_email"
                name="guardian_email"
                type="email"
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('guardian_email')}"
              >
              <has-error :form="form" field="guardian_email"></has-error>
            </div>
          </div>
          <div class="form-row">
            <div class="col mb-3">
              <label class="d-flex">Guardian's Occupation</label>
              <input v-model="form.guardian_occupation" type="text" class="form-control form-control-sm">
            </div>
            <div class="col mb-9">
              <label class="d-flex">Guardian's Home Address</label>
              <textarea v-model="form.guardian_address" type="text" class="form-control form-control-sm"/>
            </div>
          </div>
        </div>
      </div>
      <div class="shadow card-footer text-right" style="background-color: white">
        <button type="submit" class="shadow btn btn-outline-success">Save</button>
      </div>
    </form>
  </div>
</template>
<script>

    export default {

        data() {
            return {
                classrooms:{},
                section:{},
                form: new Form({
                    matric_no: '',
                    surname: '',
                    first_name: '',
                    gender: '',
                    classroom_id: '',
                    section_id: '',
                    dob: '',
                    father_name: '',
                    father_email: '',
                    father_occupation: '',
                    father_phone: '',
                    mother_name: '',
                    mother_email: '',
                    mother_occupation: '',
                    mother_phone: '',
                    guardian_name: '',
                    guardian_phone: '',
                    relationship: '',
                    guardian_email: '',
                    guardian_occupation: '',
                    guardian_address: ''
                })
            }

        },
        mounted() {
            console.log('create student vue');
        },
        methods:{
            createstudent(){
                this.form.post('/student')
            .then(response => {
                    this.$bvToast.toast("Student Details Saved! ", {
                     title: "Student Created",
                     variant: "success",
                     solid: true
          });
        })
            .catch(() => {
                     this.$bvToast.toast("Check your input fields", {
                     title: "Error",
                     variant: "danger",
                     solid: true
          });
        });
            },
            bindtofather(){
            this.form.guardian_name = this.form.father_name
            this.form.guardian_email= this.form.father_email
            this.form.guardian_occupation = this.form.father_occupation
            this.form.guardian_phone = this.form.father_phone
            this.form.relationship = "Father"
            },
            bindtomother(){
            this.form.guardian_name = this.form.mother_name
            this.form.guardian_email= this.form.mother_email
            this.form.guardian_occupation = this.form.mother_occupation
            this.form.guardian_phone = this.form.mother_phone
            this.form.relationship = "Mother"
            },
            bindtoother(){
            this.form.guardian_name =  ''
            this.form.guardian_email = ''
            this.form.guardian_occupation = ''
            this.form.guardian_phone = ''
            this.form.relationship = ''
            },
            search() {
                axios.get('/search/' + this.form.classroom_id)
                    .then(({data}) => this.section = data)
            }
        },
        created(){
              axios.get('/classroom')
            .then(({data})=> this.classrooms = data)
        }
    }


</script>
<!--TODO
    Dynamic query of class and section
    Guardian binding
    reset form
-->

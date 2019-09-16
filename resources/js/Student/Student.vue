<template>

    <div class="m-3">
        <div class="card">
            <div class="card-header">
                <!-- <div class="card-tool">

                </div> -->
                {{student.first_name}} {{student.surname}}
            </div>
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">

                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="/img/profile.png"
                                         alt="User profile picture">
                                </div>
                                <div>

                                    <h3 class="profile-username text-center" v-if="!sedit">{{student.first_name}} {{student.surname}}</h3>
                                    <div v-else>
                                        <div>
                                        <label>
                                            First Name
                                        </label>
                                            <input class="form-control form-control-sm mb-1 float-right" name="first_name"
                                            :class="{'is-invalid':form.errors.has('first_name')}"
                                            :placeholder="student.first_name" v-model="form.first_name" />
                                            <has-error :form="form" field="first_name"></has-error>
                                        </div>
                                        <div>
                                            <label>
                                                Surname Name
                                            </label>
                                            <input class="form-control form-control-sm"  name="surname"
                                            :class="{'is-invalid':form.errors.has('surname')}"
                                            :placeholder="student.surname" v-model="form.surname"/>
                                            <has-error :form="form" field="surname"></has-error>
                                        </div>


                                    </div>

                                </div>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <div>
                                            <div v-if="!sedit">
                                                <b>Matric_No</b> <a class="float-right" >{{student.matric_no}}</a>
                                            </div>

                                            <div  v-else>
                                                <label>Matric_No</label>
                                                <input class="form-control form-control-sm" name="matric_no"
                                                :class="{'is-invalid':form.errors.has('matric_no')}"
                                                :placeholder="student.matric_no" v-model="form.matric_no"/>
                                                <has-error :form="form" field="matric_no"></has-error>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div>

                                            <b>Class</b> <a class="float-right" v-if="!sedit">{{student.classroom}}</a>
                                            <div class="float-right" v-else>
                                                <label> Current class : {{student.classroom}}</label>
                                                <select class="form-control form-control-sm" name="classroom"
                                                :class="{'is-invalid' :form.errors.has('classroom')}" v-model="form.classroom" @change="search">
                                                        <option v-for="temp in classrooms" :value="temp.id" selected
                                                        :key="temp.id">{{temp.name}}</option>
                                                </select>
                                                <has-error :form="form" field="classroom"></has-error>
                                            </div>
                                             <!-- <p>{{student}}</p> -->
                                            <!-- <p>{{lol}}</p> -->
                                        </div>

                                    </li>
                                    <!-- name here is the section-->
                                    <li class="list-group-item">
                                        <div>
                                            <b>Section</b> <a class="float-right" v-if="!sedit">{{student.name}}</a>
                                            <div class="float-right" v-else>
                                                <label>Current section : {{student.name}} </label>
                                                <select class="form-control form-control-sm" name="section"
                                                :class="{'is-invalid' :form.errors.has('section')}"
                                                v-model="form.section">
                                                        <option v-for="section in sections" :value="section.id" :key="section.id">{{section.name}}</option>
                                                </select>
                                                <has-error :form="form" field="section"></has-error>
                                            </div>
                                        </div>


                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                            <b>Gender</b> <a class="float-right" v-if="!sedit">{{student.gender}}</a>
                                            <div class="float-right" v-else>
                                                <select class="form-control form-control-sm" name="gemder" :class="{'is-invalid' :form.errors.has('gender')}"
                                                :placeholder="student.gender" v-model="form.gender" >
                                                    <optgroup label="This is a group">
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </optgroup>
                                                </select>
                                                <has-error :form="form" field="gender"></has-error>

                                            </div>

                                        </div>

                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                            <b>Date of Birth</b> <a class="float-right" v-if="!sedit">{{student.dob}}</a>
                                            <div class="float-right" v-else>
                                                <input v-model="form.dob"
                                                :class="{'is-invalid':form.errors.has('dob')}"
                                                       name="dob" type="date" class="form-control form-control-sm">
                                                       <has-error :form="form" field="dob"></has-error>
                                            </div>

                                        </div>

                                    </li>
                                    <li class="list-group-item">
                                        <!--<div>-->
                                            <!--<input class="form-control form-control-sm"w/>-->
                                        <!--</div>-->
                                        <b>Term / Session</b> <a class="float-right"></a>
                                        <!--<p>{{classrooms}}</p>-->
                                    </li>
                                </ul>
                                <!-- <p>{{student}}</p> -->
                                <div class="text-right">
                                    <button class="btn btn-outline-success border rounded-circle" v-if="!sedit" @click="editstudent" v-b-tooltip.hover
                                            title="Edit"><i class="fas fa-edit"></i></button>
                                    <div v-else>
                                        <button class="btn btn-success" @click="updatestudent">Update</button>
                                        <button @click="scancel" class="btn btn-outline-danger border rounded-circle ml-2">
                                            <i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- <button @click="back">here</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#parent" data-toggle="tab">Parent
                                        Info</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" @click="fetchsubject" href="#timeline"
                                                            data-toggle="tab">Subjects & Records</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings"
                                                            data-toggle="tab">Fees</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="parent">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                <label> FATHER'S INFO</label>
                                                                <li class="list-group-item">
                                                                    <div>
                                                                        <b>Father's Name</b> <a class="float-right" v-if="!fedit">{{parent.father_name}}</a>
                                                                        <input v-else type="text" v-model="father.name" :placeholder="parent.father_name" class="form-control form-control-sm">

                                                                    </div>

                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div>
                                                                        <b>Email</b> <a class="float-right" v-if="!fedit">{{parent.father_email}}</a>
                                                                        <input type="text" v-else v-model="father.email" :placeholder="parent.father_email" class="form-control form-control-sm">

                                                                    </div>

                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Occupation</b> <a class="float-right">{{parent.father_occupation}}</a>
                                                                    <!-- name here is the section-->
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div>
                                                                        <b>Phone</b> <a class="float-right" v-if="!fedit">{{parent.father_phone}}</a>
                                                                        <input type="text" v-else v-model="father.phone" :placeholder="parent.father_phone" class="form-control form-control-sm">

                                                                    </div>

                                                                </li>
                                                            </ul>
                                                            <div class="text-right">
                                                                <button class="btn btn-outline-success border rounded-circle"
                                                                        v-if="!fedit"
                                                                        @click="editfather"
                                                                        v-b-tooltip.hover title="Edit"><i
                                                                        class="fas fa-edit"></i></button>
                                                                <div v-else>
                                                                    <button class="btn btn-success" @click="updatefather">Update</button>
                                                                    <button @click="fedit = false" class="btn btn-outline-danger border rounded-circle ml-2">
                                                                        <i class="fas fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                <label>MOTHER'S INFO</label>
                                                                <li class="list-group-item">
                                                                    <div>
                                                                        <b>Mother's Name</b> <a class="float-right" v-if="!medit">{{parent.mother_name}}</a>
                                                                        <input type="text" v-model="mother.name" class="form-control form-control-sm" v-else :placeholder="parent.mother_name">

                                                                    </div>

                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div>
                                                                        <b>Email</b> <a class="float-right" v-if="!medit">{{parent.mother_email}}</a>
                                                                        <input type="text" v-model="mother.email" class="form-control form-control-sm" v-else :placeholder="parent.mother_email">

                                                                    </div>

                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Occupation</b> <a class="float-right">{{parent.mother_occupation}}</a>
                                                                    <!-- name here is the section-->
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div>

                                                                        <b>Phone</b> <a class="float-right"v-if="!medit">{{parent.mother_phone}}</a>
                                                                        <input type="text" v-else v-model="mother.phone" :placeholder="parent.mother_phone" class="form-control form-control-sm">
                                                                    </div>

                                                                </li>

                                                            </ul>
                                                            <div class="text-right">
                                                                <button v-if="!medit" @click="editmother" class="btn btn-outline-success border rounded-circle"
                                                                        v-b-tooltip.hover title="Edit"><i
                                                                        class="fas fa-edit"></i></button>
                                                                <div v-else>
                                                                    <button class="btn btn-success" @click="updatemother">Update</button>
                                                                    <button @click="medit = false" class="btn btn-outline-danger border rounded-circle ml-2">
                                                                        <i class="fas fa-times"></i></button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">

                                            <div class="row">
                                                <div class="col">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Subject</th>
                                                                <th>Test one</th>
                                                                <th>Test two</th>
                                                                <th>Test three</th>
                                                                <th>Exam</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="record in records" :key="record.id">
                                                                <td> {{record.subject}}</td>
                                                                <td> {{record.testone}}</td>
                                                                <td> {{record.testtwo}}</td>
                                                                <td> {{record.testthree}}</td>
                                                                <td> {{record.exam}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--<p>{{records}}</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Assign subject to Student
                                                        </div>
                                                        <div class="card-body">
                                                            <!--<sinfo ></sinfo>-->
                                                            <b-alert :show="nofi" dismissible fade> Saved! </b-alert>
                                                            <div class="form-group">
                                                                <label class="mb-0" >Select Class</label>
                                                                <v-select
                                                                        multiple
                                                                        label="name"
                                                                        v-model="assign.subject"
                                                                        :options="subject[0]"
                                                                        :reduce="subject => subject.id"
                                                                ></v-select>
                                                                <p>{{assign.subject}}</p>

                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button class="btn btn-outline-dark" @click="assignsubject"> Assign </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="settings">
                                            third
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {studentevent} from '../app'

    import StudentsVue from './Students.vue';

    export default {
        name: "Student",
        props: ['student'],
        data() {
            return {
                form: new Form({
                    ssid:'',
                    id:'',
                    first_name:'',
                    surname:'',
                    matric_no:'',
                    classroom:'',
                    section:'',
                    gender:'',
                    dob:'',
                }),
                assign : new Form({
                    subject:''
                }),
               father:{
                    name:'',
                   email:'',
                   phone:'',

               },
                mother:{
                    name:'',
                    email:'',
                    phone:''
                },
                parent: '',
                records: '',
                sections:'',
                sedit:false,
                fedit:false,
                medit:false,
                hmmm:'yeah',
                subject:[],
                nofi: false
                //student edit value

                //records that is the subject scores for each subject
            }
        },
        methods: {
            okay(){
                console.log('kkkk')
            },
            back() {
                // this.selected = 'Students'
                studentevent.$emit('back');
                // this.$emit('back', this.selectedComponent);
            },
            search(){
                axios.get('/search/'+ this.form.classroom)
                    .then(({data}) => this.sections = data)
            },
            fetchsubject(){
                axios.get('/fetchsubject' ,{
                    params: {
                        student: this.student.student_id
                }})
                    .then(({data}) => this.subject = data);
                axios.get('/getrecords', {
                    params: {
                        student_id: this.student.student_id
                    }
                })
                    .then(({data}) => (this.records = data));
            },
            assignsubject(){
                axios.post('/subject/Regstudent',{
                    subject: this.assign.subject,
                    student: this.student.student_id,
                }).then(response => {
                    this.nofi = true;
                })


            },
            editstudent(){
               this.sedit = true;
               this.form.first_name = this.student.first_name;
               this.form.surname = this.student.surname;
               this.form.matric_no = this.student.matric_no;
               this.form.classroom = this.student.classroom_id;
               this.form.section = this.student.section_id;
               this.form.gender = this.student.gender;
               this.form.id = this.student.student_id;
               this.form.ssid = this.student.id;
               this.form.dob = this.student.dob;
               // this.form.section = this


            },
            editfather(){
                this.fedit = true;
            },
            editmother(){
                this.medit = true;
            },
            scancel(){
                this.sedit = false;
            },
            updatestudent(){
                this.form.post('/updatestudent')
                    .then(response => {
                    this.$bvToast.toast("Student Details Saved! ", {
                     title: "Student Updated",
                     variant: "success",
                     solid: true
          });

        }, this.sedit = false
        )
        .catch(() => {
                     this.$bvToast.toast("Check your input fields", {
                     title: "Error",
                     variant: "danger",
                     solid: true
          });
        });
            },
            updatemother(){},
            updatefather(){},

            // created(){
            // console.log('here');
            // },

        },

        activated() {
            this.$store.dispatch('loadsections');

            axios.get('/search/'+ this.student.classroom_id)
                    .then(({data}) => this.sections = data)


                      // alert(this.student.id);
            axios.get('/getparent', {
                params: {
                    student_id: this.student.student_id
                }
            })
                .then(({data}) => (this.parent = data));
            axios.get('/getrecords', {
                params: {
                    student_id: this.student.student_id
                }
            })
                .then(({data}) => (this.records = data));

        },
        deactivated(){
            this.sedit=false;
        },
        computed:{
            classrooms(){
                return this.$store.state.classrooms;
            },
            // lol(){
            //     return this.$store.state.sections;
            // },
            // search(){
            //     axios.get('/search/'+ this.form.classroom)
            //         .then(({data}) => this.sections = data)
            // }
        }
    }
</script>

<style scoped>

</style>

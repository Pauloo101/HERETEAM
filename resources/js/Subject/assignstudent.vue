<template>
  <div class="col-md-3">
    <div class="card">
      <div>
        <ul class="nav nav-tabs nav-justified">
          <li class="nav-item">
            <a
              role="tab"
              data-toggle="tab"
              class="nav-link active"
              href="#tab-1"
            >Assign subject to class</a>
          </li>
          <li class="nav-item">
            <a role="tab" data-toggle="tab" class="nav-link" href="#tab-2">Assign subject to student</a>
          </li>
        </ul>
        <div class="tab-content">
          <!-- assign subject to class tab content -->
          <div role="tabpanel" style="background-color:#F8FAFC" class="tab-pane active" id="tab-1">
            <div class="card-body p-3">
              <div class="field">
                <label class="mb-0" >Select Subject</label>

                <select class="form-control form-control-sm" v-model="subject">
                  <optgroup label="These are subject">
                    <option
                      v-for="subject in subjects"
                      :key="subject.id"
                      :value="subject.id"
                    >{{subject.name}}</option>
                  </optgroup>
                </select>
              </div>
              <div class="field">
                <label class="mb-0" >Select Class</label>
                <v-select
                  multiple
                  label="name"
                  v-model="classroom"
                  :options="classrooms"
                  :reduce="classrooms => classrooms.id"
                ></v-select>
              </div>
              <!-- <p>{{classroom}} {{subject}}</p> -->
            </div>
            <div class="card-footer">
              <button class="btn btn-outline-primary" @click="subtoclass" :disabled="btnclass">Save</button>
            </div>
          </div>
          <!-- Assign subject to student -->
          <div role="tabpanel" style="background-color:#F8FAFC" class="tab-pane" id="tab-2">
            <div class="card-body p-3">
              <div class="field">
                <label class="mb-0" >Select Subject</label>
                <select @change="fetchclass" class="form-control form-control-sm" v-model="subject" >
                  <optgroup label="There are subject">
                    <option
                      v-for="subject in subjects"
                      :key="subject.id"
                      :value="subject.id"
                    >{{subject.name}}</option>
                  </optgroup>
                </select>
              </div>
              <div class="field">
                <label class="mb-0" >Select Students in</label>
                <!-- <p>{{section}}</p> -->

                <!-- <v-select
                  multiple
                  label="name"
                  v-model="classroom"
                  :options="classrooms"
                  :reduce="classrooms => classrooms.id"
                ></v-select>-->

                <select class="form-control form-control-sm" v-model="classroom" @change="search">
                  <optgroup label="This is a group">
                    <option v-for="temp  in here" :key="temp.id" :value="temp.id">{{temp.name}}</option>
                  </optgroup>
                </select>
              </div>

              <div>
                <label class="mb-0" >Select Section</label>
                <select class="form-control form-control-sm"  v-model="section" >
                  <optgroup label="This is a group">
                      <option value="all" selected>All</option>
                    <option
                      v-for="temp in sections"
                      :key="temp.id"
                      :value="temp.id"
                      selected
                    >{{temp.name}}</option>
                  </optgroup>
                </select>
              </div>

              <!--<div class="mt-2">-->
                <!--&lt;!&ndash; DIRECT CHAT PRIMARY &ndash;&gt;-->
                <!--<div class="card card-primary card-outline">-->
                  <!--<div class="card-header form-control">-->
                    <!--<h6>More Options</h6>-->
                    <!--<div class="card-tools">-->
                      <!--<button type="button" class="btn btn-tool" data-widget="collapse">-->
                        <!--<i class="fa fa-minus"></i>-->
                      <!--</button>-->
                    <!--</div>-->
                  <!--</div>-->

                  <!--<div class="card-body"></div>-->

                  <!--<div class="card-footer"></div>-->
                <!--</div>-->
              <!--</div>-->
            </div>
            <div class="card-footer">
              <!-- <p>{{subject}}|{{classroom}}|{{section}}</p> -->
              <button class="btn btn-outline-success" @click="subtostud" :disabled="btnsub">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      subject: "",
      classroom: "",
      here: "",
      sections:"",
      section:"",
    };
  },
  computed: {
    subjects() {
      return this.$store.state.subjects;
    },
    classrooms() {
      return this.$store.state.classrooms;
    },
    btnclass() {
      if (this.subject == null || this.classroom.length <= 0) {
        return true;
      } else return false;
    },
    btnsub(){
        if(this.subject == null || this.section == ''){
            return true;
        }else return false;
    }
  },
  created() {
    this.$store.dispatch("loadclassrooms");
  },
  methods: {
    subtoclass() {
      axios
        .post("/subject/assignclass", {
          subject_id: this.subject,
          classroom_id: this.classroom
        })
        .then(response => {
          this.$bvToast.toast("Subject Assigned ", {
            title: "subject assigned to class!",
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
    fetchclass() {
      axios
        .get("/fetchclass/" + this.subject)
        .then(({ data }) => (this.here = data));
    },
    //class and section
    search(){
        axios.get('/search/'+ this.classroom)
            .then(({data}) => this.sections = data)
    },
    subtostud(){
      axios.post('/subject/Regclass',{subject: this.subject, classroom: this.classroom, section:this.section
      })
      .then((response)=>{
          Toast.fire({
              type:'success',
              title:response.data
          })
      })
      .catch((e =>{
        //   console.log(e.response)
          Toast.fire({
              type:'error',
              title:'Processing this would cause duplicate entry',
              timer:9000
          })
      }))
    }
  }
};
</script>

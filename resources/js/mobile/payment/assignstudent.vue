<template>
  <div class="card">
    <div class="card-header">Assign Bill to Student</div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4 col-xs-12">
          <div class="">
            <v-select
              class="bg-light"
              label="id"
              clearable
              :filterable="false"
              v-model="student"
              @input="getsettingpayment"
              @search="searchstudent"
              :options="students"
            >

              <template slot="no-options">Enter the name of the students</template>
              <template slot="option" slot-scope="option">
                <div class="text-center">{{option.first_name}} {{option.surname}}</div>
              </template>
              <template slot="selected-option" slot-scope="option">
                <div class="text-center">{{option.first_name}} {{option.surname}}</div>
              </template>
            </v-select>
          </div>
          <div class=" mt-4">
            <div class="card p-0">
              <div class="card-header bg-primary">Payments Already Assigned</div>
              <div class="card-body p-1">
                <ul class="list-group">
                  <li class="list-group-item" v-b-popover.hover.left="p.total + ' ' + 'has been paid'" title="Payment history" variant="p.total"
                   v-for="p in payments" :key="p.id" >

                    <span class="float-left">{{p.name}}</span>
                    <span class="float-right">{{p.amount}}</span>
                  </li>
                </ul>
                <!-- <p>{{payments}}</p> -->
                <!-- <b-popover
                    :target="id"
                    title="Prop Examples"
                    triggers="hover focus"
                    content="Embedding content using properties is easy"
                ></b-popover> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col">
             <!-- <p>{{students}}</p> -->
            <div class="callout callout-success bg-light">
          <h6>
            <i class="fa fa-info p-0"></i>
            Student Info
          </h6>
          <div v-if="student != null">
          <label class="p-0 mr-3">Matric_no: {{student.matric_no ? student.matric_no : '----'}}</label>
          <label class="p-0 mr-3">First Name: {{student.first_name ? student.first_name: '----'}}</label>
          <label class="p-0 mr-3">Surname: {{student.surname ? student.surname: '----'}}</label>
          <label class="p-0 mr-3">gender: {{student.gender ? student.gender: '----'}}</label>
          <label class="p-0 mr-3">Class: {{student.classroom ? student.classroom: '----'}} </label>
          <label class="p-0 mr-1">section:{{student.section ? student.section:'----'}} </label>
          </div>
          <div v-else>
              <label class="text-danger">No student Selected</label>
          </div>

        </div>

          <div class="table-responsive table-bordered hover shadow">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(c , index) in compare" :key="index" >
                  <td>{{c.name}}</td>
                  <td>{{c.amount}}</td>
                  <td>
                      <div v-if="c.assign == 1">
                         <button @click="unassign(c,index)" class="btn btn-secondary"></button> Unassign
                      </div>
                      <div v-else>
                        <button  id="assign" @click="assign(c, index)" class="btn btn-outline-secondary"></button> Assign
                      </div>

                  </td>
                </tr>
              </tbody>
            </table>
            <!-- <button @click="comparing">lol</button> -->
            <!-- <p>{{compare}}</p> -->
          </div>
        </div>

      </div>

         <!-- Advanced Assign -->
        <div>
            <multiassign></multiassign>
        </div>

    </div>
  </div>
</template>

<script>
import multiassign from './multiassign'
// let compare  = [];
// let bills;
// let pay;
export default {
    components: {multiassign},
    // compare,
  data() {
    return {
      students:[],
      student:null,
      payments:'',
      id:'',
      bill:'',
      bills:[],
      pay:[],
      compare:[],
      cache:[],
    //   assign:[],
    //   unassign:[],
      value:true
    //   test:compare,
    };
  },
  methods: {
    searchstudent(search, loading){
        loading(true);
       axios.get('/searchstudent', {
           params: {
               search : search
           }
       })
       .then((response) => {
            this.students = response.data
           loading(false);
       }
       )
       .catch((e) => {
           console.log(e)
       })
    //    loading(false);
    },
    getsettingpayment() {
        this.$Progress.start()
        //
            if((this.student == null) || (this.student == '')||(this.student == undefined)){
                this.compare = []
                this.pay = []
                this.bills  = []
                this.payments = []
                this.bill = ''
            }
            else{
                 this.compare = []
                this.pay = []
                this.bills  = []
                this.payments = []
                this.bill = ''
                axios.get('/getsettingpayment',{
                        params:{
                            student: this.student.id
                        }
                    })
                    .then((response) => {
                        this.payments = response.data
                        this.fetchbill();
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            }
    },
    fetchbill(){
        axios.get('/fetchbill',{
            params:{
                classroom:this.student.classroomid,
                // section:this.student.section
            }
        })
        .then((response) => {
            this.bill = response.data
            this.comparing();
        })
        .catch(()=>{
            console.log(e);
        })
        Fire.$emit('compare')
        // this.comparing();
    },
    comparing(){
        this.compare = []
        if((this.student == null)||(this.student == '')){
            this.compare = []
        }
        else{
         for (let i = 0; i < this.bill.length; i++) {
                this.bills.push(this.bill[i].id)
             }
                    //   console.log(this.bills)
            for (let x = 0; x < this.payments.length; x++) {
                this.pay.push(this.payments[x].id)
            }
            let hum =[];
                     hum = _.intersection(this.bills, this.pay);
                    let diff = _.difference(this.bills, this.pay)
                    //   console.log(hum)
                    for (let i = 0; i < this.bill.length; i++) {
                        let id = this.bill[i].id
                        var found = hum.find(function(element) {
                        return element == id;
                        })
                        // console.log(found + 'h' + this.bill[i].id)
                        if(found == undefined){
                            let assign = {assign : 0}
                            this.bill[i] = Object.assign(this.bill[i] , assign)
                            this.compare.push(this.bill[i])
                        }else{
                            let assign = {assign : 1}
                            this.bill[i] = Object.assign(this.bill[i] , assign)
                            this.compare.push(this.bill[i])
                        }
                    }
        }
           this.$Progress.finish()
    },
    assign(c , index){
        this.$Progress.start()

        axios.post('/assignpayment',{payment:c.id , student:this.student.id})
        .then(() => {
            this.$bvToast.toast("Payment Assigned", {
            title: "Action Successful",
            variant: "success",
            solid: true
          });
          this.$Progress.finish()
          this.compare[index].assign = 1
            this.cache = this.compare
            this.compare = [];
            this.compare = this.cache;
            Fire.$emit('assign')
        })
        .catch(() => {
             this.$bvToast.toast('An Error Occured', {
            title: "Error",
            variant: "danger",
            solid: true
          });
             this.$Progress.fail()
        })


    },
    unassign(c, index){
    this.$Progress.start()
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!  All payment history will be removed as well" ,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, Unassign Payment!'
}).then((result) => {
  if (result.value) {
      axios.post('/unassignpayment',{payment:c.id , student:this.student.id})
    .then(()=>{
        this.compare[index].assign = 0
        this.cache = this.compare
        this.compare = [];
        this.compare = this.cache;
    //sweet alert
    Swal.fire(
      'Unassigned!',
      'Payment has been unassign.',
      'success'
    )
        Fire.$emit('assignstudent')
    this.$Progress.finish()
    })
    .catch(()=>{
        Toast.fire({
            type: 'error',
            title: ' Pls contact admin'
        })
        this.$Progress.fail()
    })
  }
  this.$Progress.finish()
})
        //condition for removing the payment history

    }
  },
  computed: {
      com(){
        //   let data
        //   return data
      }
  },
  created() {
      Fire.$on('compare',()=>{
          this.comparing()
      })

    Fire.$on('input',()=>{
        this.compare = []
    })
    Fire.$on('assignstudent',()=>{
    axios.get('/getsettingpayment',{
          params:{
              student: this.student.id
                }
          })
          .then((response) => {
            this.payments = response.data
            // this.fetchbill();
        })
      .catch((e) => {
         console.log(e)
               })
    })
  },
};
</script>

<style>
</style>

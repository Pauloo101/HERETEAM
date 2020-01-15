<template>
  <div>
    <div class="row">
      <div class="col-3">
        <form @submit.prevent="fetch" @keydown="form.onKeydown($event)">
          <div class="card">
            <div class="card-header">
                Check Overview 
              <!-- <alert-error :form="form"></alert-error> -->
              <!-- {{classrooms}} -->
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Select Payment</label>
                <select
                  class="form-control form-control-sm"
                  name="payment"
                  v-model="form.payment"
                  :class="{'is-invalid':form.errors.has('payment')}"
                >
                  <optgroup label="Select Payment">
                    <option v-for="(p , index) in payments" :key="index" :value="p">{{p}}</option>
                  </optgroup>
                </select>
                <has-error :form="form" field="payment"></has-error>
              </div>
              <div class="form-group">
                <label>Select Classroom</label>
                <select
                  class="form-control form-control-sm"
                  name="classroom"
                  v-model="form.classroom"
                  :class="{'is-invalid':form.errors.has('classroom')}"
                >
                  <optgroup label="Select Class">
                    <option v-for="c in classrooms" :key="c.id" :value="c.id">{{c.name}}</option>
                  </optgroup>
                </select>
                <has-error :form="form" field="classroom"></has-error>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-sm btn-outline-info" type="submit">Fetch</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-header">
            Payment Info
            <div class="card-tools"></div>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Total Student</th>
                  <th scope="col">Total</th>
                  <th scope="col">Total Paid</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>{{count}}</td>
                  <td>{{total}}</td>
                  <td>{{pending}}</td>
                </tr>
              </tbody>
            </table>
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
      form: new Form({
        classroom: "",
        payment: ""
      }),
      count: "",
      amount: "",
      total: "",
      pending: 0,

      payments: []
    };
  },
  created() {
    this.$store.dispatch("loadclassrooms");
    axios
      .get("/fetchpayment")
      .then(response => {
        let data = _.uniq(response.data);
        this.payments = data;
        // console.log(this.payments);
      })
      .catch(err => {
        console.log(err);
      });
  },
  computed: {
    classrooms() {
      return this.$store.state.classrooms;
    }
  },
  methods: {
    fetch() {
      this.form
        .post("/getstats")
        .then(response => {
          let data = response.data;
          this.count = data.count;
          this.amount = data.amount;
          this.total = data.total;
          data.pending.forEach(element => {
            this.pending = element.pending + this.pending;
          });
          //   this.pending = data.pending
        //   console.log(data);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

<style>
</style>

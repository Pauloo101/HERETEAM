<template>
  <div class="card">
    <div class="card-header">
      <label>Create a Product</label>
      <div class="card-tools">
        <button class="btn btn-sm btn-outline-info">import product</button>
      </div>
    </div>
    <div class="card-body">

      <form @submit.prevent="createproduct" @keydown="form.onKeydown($event)">
          <alert-error :form="form"></alert-error>
          <div class="form-group">
        <label>Name</label>
        <input name="product"
          :class="{'is-invalid' :form.errors.has('product')}"
          v-model="form.product"
          class="form-control form-control-sm"
          placeholder="Enter product name"
        />
        <has-error :form="form" field="product"></has-error>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label>Quantity</label>
            <input name="quantity" type="number"
              :class="{'is-invalid':form.errors.has('quantity')}"
              v-model="form.quantity"
              class="form-control form-control-sm"
              placeholder="Entetr Quantity"
            />
            <has-error :form="form" field="quantity"></has-error>
          </div>
          <div class="col">
            <label>Unit price</label>
            <input name="price" type="number"
             :class="{'is-invalid':form.errors.has('price')}"
              v-model="form.price"
              class="form-control form-control-sm"
              placeholder="Enter the price"
            />
            <has-error :form="form" field="price"></has-error>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Category</label>
        <input name="category"
        :class="{'is-invalid':form.errors.has('category')}"
          v-model="form.category"
          class="form-control form-control-sm"
          placeholder="Enter the category"
        />
        <has-error :form="form" field="category"></has-error>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea :class="{'is-invalid' :form.errors.has('description')}" v-model="form.description" name="description"
        class="form-control form-control-sm" placeholder="Description here" />
      </div>
      <div class="form-group">
        <label>Suppler</label>
        <select class="form-control form-control-sm">
          <option></option>
        </select>
      </div>
      </form>

    </div>
    <div class="card-footer">
        <button class="btn btn-outline-success" type="submit" @click="createproduct">Save</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        product: "",
        quantity: "",
        price: "",
        category: "",
        description: "",
        supplier_id: ""
      })
    };
  },
  methods: {
      createproduct(){
          this.form.post('/createproduct')
          .then(response =>{
              Toast.fire({
                  type: "success",
                  title: "product created"
              });
          }).catch((e)=>{
              Toast.fire({
                  type: "error",
                  title: "An Error"
              })
          })
      }
  },
};
</script>

<style>
</style>

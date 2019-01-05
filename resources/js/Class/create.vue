<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Class.vue
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createclass" @keydown="form.onKeydown($event)">
                            <alert-error :form="form"></alert-error>
                               <div>
                                   <input placeholder="Class name" v-model="form.name" class="form-control" name="name" type="text" :class="{ 'is-invalid':form.errors.has('name')}"/>
                                   <has-error :form="form" field="name"></has-error>
                               </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" style="margin-left: 5px">Create</button>
                                <button class="btn btn-primary">Show</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import HasError from "vform/src/components/HasError";
    export default {
        components: {HasError},
        data(){
            return{
                form: new Form({
                    name:'',
                })
            }
        },
        methods:{
            createclass(){
                this.form.post('/Class').then(classroom => alert('class created'));
            }
        },

        mounted() {
            console.log('Component mounted.')
        }}
</script>

<style scoped>

</style>
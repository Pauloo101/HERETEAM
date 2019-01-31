<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create subject.vue
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createsubject" @keydown="form.onKeydown($event)">
                            <alert-error :form="form"></alert-error>
                            <div>
                                <input placeholder="Subject name" v-model="form.name" class="form-control" name="name" type="text" :class="{ 'is-invalid':form.errors.has('name')}"/>
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" style="margin-left: 5px">Create</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                form: new Form({
                    name:''
                })
            }
        },
        methods:{
            createsubject(){
                this.form.post('/subject').then(subject => alert('subject created'));
            }
        }
    }
</script>
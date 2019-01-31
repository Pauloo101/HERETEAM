<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        toolbar.vue
                    </div>
                    <div class="card-body">
                        <a href="/student/create" class="btn btn-primary">Add Student.laravel</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter">
                            Add Student.vue
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="creatstudent" @keydown="form.onKeydown($event)">
                        <alert-error :form="form"></alert-error>
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.first_name" type="text" name="first_name" placeholder="FirstName"
                                       class="form-control" :class="{ 'is-invalid':form.errors.has('first_name')}"/>
                                <has-error :form="form" field="first_name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.last_name" type="text" name="last_name" placeholder="LastName"
                                       class="form-control"
                                       :class="{ 'is-invalid':form.errors.has('last_name')}"/>
                                <has-error :form="form" field="last_name"></has-error>

                            </div>
                            <div class="form-group">
                                <input v-model="form.matric_no" type="text" name="matric_no" placeholder="matric_no"
                                       class="form-control" :class="{ 'is-invalid':form.errors.has('matric_no')}"/>
                                <has-error :form="form" field="matric_no"></has-error>

                            </div>
                            <div class="form-group">
                                <input v-model="form.gender" type="text" name="gender" placeholder="Gender"
                                       class="form-control" :class="{ 'is-invalid':form.errors.has('gender')}"/>
                                <has-error :form="form" field="gender"></has-error>

                            </div>
                            <div class="form-group">
                                <input v-model="form.DOB" type="text" name="DOB" placeholder="DOB"
                                       class="form-control"/>

                            </div>
                            <select placeholder="Select Class" v-model="form.classroom_id" name="classroom_id" class="form-control">
                                <option value="1"> JSS1</option>
                                <option value="2"> JSS2</option>
                            </select>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add student</button>
                        </div>
                    </form>

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
                    first_name: '',
                    last_name: '',
                    matric_no: '',
                    gender: '',
                    DOB: '',
                    classroom_id: ''
                })
            }
        },
        methods: {
            creatstudent() {
                this.form.post('/student').then(student => alert('all done'));
            }
        },
        mounted() {
            console.log('Component mounted.');

        }
    }
</script>

<style scoped>

</style>
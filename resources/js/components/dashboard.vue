<template>
    <div class="container">
        <div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      Dashboard.vue
                    </div>
                    <!--there is a problem in the controller return stmt for student-->
                    <!--fix would be through api route-->
                    <div class="card-body">
                        <ul class="list-group" v-for="student in students" :key="student.id">
                            <li class="list-group-item"><p> {{student.first_name}} </p></li>
                            <li class="list-group-item"><span>{{student.classroom_id}}</span></li>
                            <li class="list-group-item"><span>{{student.gender}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                students : []
            }
        },
        //wen created fire of an ajax request and fetch all student
        // object destructuring trick
        mounted(){
            axios.get('/dashboard')
                .then(({data}) => this.students = data);
        }
    }
</script>

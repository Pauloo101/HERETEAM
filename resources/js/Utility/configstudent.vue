<template>
    <div>
        <div class="card mt-2">
            <div class="card-header">
                <button class="btn btn-outline-dark" @click="selectedComponent = 'Students'" >
                    <i class="fas fa-arrow-alt-circle-left"></i></button>
                    <button @click="selectedComponent = 'Student'" class="btn btn-outline-info">
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </button>
                    <!-- <p>{{student}}</p> -->
                    <!-- <label v-show="selectedComponent = 'Students'">Student OverView </label> -->
            </div>
        <keep-alive>
            <component :is="selectedComponent" :student="student">

            </component>
        </keep-alive>
    </div>
    </div>
</template>

<script>
    // import { studentevent } from '../app'
    import Students from '../Student/Students';
    import Student from '../Student/Student';
import { studentevent } from '../app';
    export default {
        name: "configstudent",
        data(){
            return {
                selectedComponent: "Students",
                student:'',
            }
        },
        components:{
            Students:Students,
            Student: Student
        },
        computed:{

        },
        created(){
            studentevent.$on('back', (data) => {
                this.selectedComponent = 'Students'
            });
            studentevent.$on('student', (data) =>{
                this.selectedComponent = 'Student'
                this.student = data
            })
        }
    }
</script>

<style scoped>

</style>

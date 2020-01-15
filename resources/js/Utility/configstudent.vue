<template>
    <div>
        <div class="card mt-2">
            <div class="card-header pr-3 pt-1 pl-1 pb-1">
                <label>Student OverView</label>
               <div class="card-tools">
                    <button v-show="selectedComponent == 'Student'" class="btn btn-outline-danger" @click="selectedComponent = 'Students'" >
                    <i class="fas fa-arrow-alt-circle-left"></i></button>
                    <!-- <button  @click="selectedComponent = 'Student'" class="btn btn-outline-info">
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </button> -->
               </div>
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

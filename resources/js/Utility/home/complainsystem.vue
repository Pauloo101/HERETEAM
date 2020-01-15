<template>
    <div>
        <keep-alive>
            <component :is="selected" :complain="complain"></component>
        </keep-alive>
    </div>
</template>

<script>
import complains from './complains';
import reply from './reply';
export default {
    // props:{data},
    name:'complainsystem',
    components:{
        complains:complains,
        reply:reply,
    },
    data() {
        return {
            selected:'complains',
            complain:''
        }
    },
    created() {
        Fire.$on('read',(data) => {
            this.selected = 'reply'
            this.complain = data
            // console.log(data);
        });
        Fire.$on('back', () =>{
            this.selected = 'complains'
        })
    },
}
</script>

<style>

</style>

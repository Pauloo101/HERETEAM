import {extend} from 'vee-validate'
import {required} from 'vee-validate/dist/rules'

extend('positive', value=>{
    if (value >= 0){
        return true;
    }
    return 'This field must be a positive number';
});
extend('min',{
    validate(value, args){
        if (value.length >= args.length) {
            return true
        }else{
            return 'It must be a least ' + args.length + 'characters'
        }
    },
    params:['length']
})
extend('required',{
    ...required,
    message: 'This field is required'
})

@extends('layouts.app')

@section('content')
    <div>
        <form style="padding: 250px;" method="post" action="{{ route('StudentController@update',$student)}}" >
            @csrf
            {{method_field('PATCH')}}
            <input type="text" class="form-control" name="matric_no" placeholder="matric_no" value="{{$student->matric_no}}" style="margin-bottom: 10px;"/>
            <input class="form-control" type="text" name="first_name" placeholder="first_name" value="{{$student->first_name}}" style="  margin-bottom: 10px;"/>
            <input type="text" class="form-control" name="last_name" placeholder="last_name" value="{{$student->last_name}}" style="  margin-bottom: 10px;"/>
            <input type="text" class="form-control" name="gender" placeholder="gender" value="{{$student->gender}}" style="  margin-bottom: 10px;"/>
            <input type="text" class="form-control" name="DOB" placeholder="DOB" value="{{$student->DOB}}" style="margin-bottom: 10px;"/>
            <button type="submit" class="btn-primary">Update</button>

        </form>
    </div>




@endsection

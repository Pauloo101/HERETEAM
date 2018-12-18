@extends('layouts.master')
@section('content')

        <form method="post" action="{{ route('student.update',$id)}}" >
            @csrf
            {{method_field('put')}}
            <input type="text" class="form-control" name="matric_no" placeholder="matric_no" style="  margin-bottom: 10px;" value="{{$student->matric_no}}"/>
            <input class="form-control" type="text" name="first_name" placeholder="first_name" style="  margin-bottom: 10px;" value="{{$student->first_name}}"/>
            <input type="text" class="form-control" name="last_name" placeholder="last_name" style="  margin-bottom: 10px;" value="{{$student->last_name}}"/>
            <input type="text" class="form-control" name="gender" placeholder="gender" style="  margin-bottom: 10px;" value="{{$student->gender}}"/>
            <input type="text" class="form-control" name="DOB" placeholder="DOB" style="margin-bottom: 10px;" value="{{$student->DOB}}"/>
            <button type="submit" class="btn-primary">Create Student</button>

        </form>
        <script src="{{ asset('js/app.js') }}"></script>
@endsection
@extends('layouts.master')
@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Student</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('student.store') }}" >
                        @csrf
                        <input type="text" class="form-control" name="matric_no" placeholder="matric_no" style="  margin-bottom: 10px;"/>
                        <input class="form-control" type="text" name="first_name" placeholder="first_name" style="  margin-bottom: 10px;"/>
                        <input type="text" class="form-control" name="last_name" placeholder="last_name" style="  margin-bottom: 10px;"/>
                        <input type="text" ibnclass="form-control" name="gender" placeholder="gender" style="  margin-bottom: 10px;"/>
                        <input type="text" class="form-control" name="DOB" placeholder="DOB" style="margin-bottom: 10px;"/>
                        <input type="file" name="photo">
                        <select name="classroom_id" class="form-control" >
                            @foreach($classroom as $classrooms)
                                <option value="{{$classrooms->id}}"> {{$classrooms->name}} </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-primary">Create Student</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{--<div>--}}

    {{--</div>--}}
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

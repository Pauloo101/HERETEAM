@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile
                        <img src="/img/{{$teacher->photo}}">
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('teacher.update',$id) }}">
                            @csrf
                            {{method_field('put')}}
                            <input type="text" class="form-control" name="name" placeholder="Name"
                                   value="{{$teacher->name}}" style="  margin-bottom: 10px;"/>
                            <input class="form-control" type="text" name="username" placeholder="username"
                                   value="{{$teacher->username}}" style="  margin-bottom: 10px;"/>
                            <input type="text" class="form-control" name="email" placeholder="email"
                                   value="{{$teacher->email}}" style="  margin-bottom: 10px;"/>
                            <input type="text" ibnclass="form-control" name="class_id" placeholder="class_id"
                                   value="{{$teacher->class_id}}" style="  margin-bottom: 10px;"/>
                            <input type="text" class="form-control" name="role" placeholder="role"
                                   value="{{$teacher->role}}" style="margin-bottom: 10px;"/>
                            <input type="file" name="photo" value="{{$teacher->photo}}">
                            <button type="submit" class="btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection